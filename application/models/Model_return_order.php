<?php 

	class Model_return_order extends Model_adapter
	{
		public $_table_name = 'return_orders';

		public $_fillables = [
			'order_id' , 'user_id',
			'reference',
			'status' , 'reason',
			'updated_by' , 'returned_amount',
			'remarks' , 'created_at'
		];

		public function create( $return_data )
		{
			$return_items = $return_data['return_items'];
			$_fillables = $this->getFillablesOnly($return_data);

			$_fillables['reference'] = $this->generateReference();
			//return data

			$return_order_id = parent::create( $_fillables );


			foreach($return_items as $item) {

				$this->dbinsert('return_order_items' , [
					'product_id' => $item['product_id'],
					'return_qty' => $item['return_qty'],
					'order_qty' => $item['order_qty'],
					'return_id' => $return_order_id,
				]);
			}

			$this->addMessage("Return Order Request Created : #{$_fillables['reference']}");

			/*
			*preparing notifications
			*/
			$href = '/returnOrder/show/'.$return_order_id;
			$user = $this->model_users->getUserData($_fillables['user_id']);
			//system notification
			$this->model_notification->create_system("Return Order Request #{$_fillables['reference']}" , 
				[$_fillables['user_id']] , ['href' => $href]);
			//system operations notification
			$this->model_notification->message_operations("Return Order Request #{$_fillables['reference']}" , ['href' => $href]);
			//email notification
			$this->model_notification->create_email("Return Order Request #{$_fillables['reference']} , 
					login to your account to view complete return details." , [$user['email']]);
			//add notifications
			return $return_order_id;
		}

		public function generateReference()
		{
			return strtoupper('RT-ORDER-'.generateRandomString('8'));
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE .".$this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			return $this->queryResultArray(
				"SELECT ret.* , user.* , ret.id as id 
					FROM {$this->_table_name} as ret
					LEFT JOIN users as user 
					ON user.id = ret.user_id 
					{$where} {$order} "
			);
		}


		public function get($id)
		{
			return $this->getAll([
				'where' => [
					'ret.id' => $id
				]
			])[0];
		}

		public function getComplete($id)
		{
			$return_order = $this->getAll([
				'where' => [
					'ret.id' => $id
				]
			])[0];

			$items = $this->getItems($id);


			$return_order['items'] = $items;

			return $return_order;
		}

		public function getItems($return_order_id)
		{
			$items = $this->queryResultArray(
				"SELECT item.* , product.name as name FROM return_order_items as item 
					LEFT JOIN products as product
					ON product.id = item.product_id

					WHERE return_id = '{$return_order_id}' "
			);

			return $items;
		}

		public function updateStatus($status , $id)
		{
			return parent::update([
				'status' => $status
			] , $id);
		}


		public function invalid($return_order_data)
		{
			$return_order = $this->get( $return_order_data['id'] );
			$return_order_process_text = $this->model_return_process->get()['text_content'];
			
			$user_data = $this->model_users->getUserData($return_order['user_id']);

			$res = parent::update([
				'status' => $return_order_data['status'],
				'rermarks' => $return_order_data['rermarks']
			] , $return_order_data['id']);

			if($res) {
				$this->addMessage("Return Order Updated to invalid");
			}else{
				$this->addError("Return Order update to invalid Failed");
				return false;
			}

			$link = '/returnOrder/show/'.$return_order_id['id'];

			$this->model_notification->message_operations("Order Return #{$return_order['reference']} has been invalidated view to check reason" , [
				'href' => $link
			]);

			$this->model_notification->create_system("Your return Order #{$return_order['reference']} has been invalidated", [$return_order['user_id']] , [
				'href' => $link
			]);

			send_sms("Your return Order #{$return_order['reference']} has been invalidated , login your account to check details" , [$user_data['phone']]);


			
			return $res;
		}
		public function approve($return_order_data)
		{
			$return_order = $this->get( $return_order_data['id'] );
			$return_order_process_text = $this->model_return_process->get()['text_content'];
			
			$user_data = $this->model_users->getUserData($return_order['user_id']);

			$res = parent::update([
				'status' => $return_order_data['status'],
				'rermarks' => $return_order_data['rermarks']
			] , $return_order_data['id']);

			if($res) {
				$this->addMessage("Return Order Approved");
			}else{
				$this->addError("Return Order Approved Failed");
				return false;
			}

			$link = '/returnOrder/show/'.$return_order_id['id'];

			$this->model_notification->message_operations("Order Return #{$return_order['reference']} has been approved" , [
				'href' => $link
			]);

			$this->model_notification->create_system("Your return Order #{$return_order['reference']} has been approved,
				please check your email and follow the steps sent", [$return_order['user_id']] , [
				'href' => $link
			]);

			$steps_to_return = <<<EOF
				<p>Your return order has been approved please follow the steps below.</p>
				{$return_order_process_text}
			EOF;

			$this->model_notification->create_email("Return Order Approved" , $steps_to_return);

			send_sms("Order Return #{$return_order['reference']} has been approved" , [$user_data['phone']]);


			
			return $res;
		}
	}