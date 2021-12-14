<?php 


	class Model_delivery extends Model_adapter
	{
		public $_table_name = 'deliveries';

		public $_fillables = [
			'id',
			'order_id',
			'user_id',
			'date',
			'cx_name',
			'cx_email',
			'cx_phone',
			'cx_address',
			'description',
			'received_by',
			'status',
			'remarks',
			'created_at',
			'updated_at'
		];

		public function create( $delivery_data )
		{
			$_fillables = $this->getFillablesOnly($delivery_data);

			$_fillables['reference'] = $this->reference();
			$_fillables['status'] = 'for-delivery';

			$res = parent::create($_fillables);

			if($res) 
			{
				$order = $this->model_orders->getOrdersData( $_fillables['order_id'] );

				$link = '/Orders/show/'.$order['id'];


				$this->model_notification->create_system(
					"Your order #{$order['bill_no']} is expected to be delivered on {$_fillables['date']}",
					[$order['user_id']],
					['href' => $link]
				);

				send_sms("Your order #{$order['bill_no']} is expected to be delivered on {$_fillables['date']}" , [$order['customer_phone']]);

				$this->model_notification->create_email(
					"Order Delivery Update",
					"Your order #{$order['bill_no']} is expected to be delivered on {$_fillables['date']}. <br/>
					Delivery #{$_fillables['reference']}, <br/>
					Delivery Status {$_fillables['status']}",

					[$order['customer_email']]
				);

				$this->model_notification->message_operations("Order #{$order['bill_no']}
					has been set for-delivery on date {$_fillables['date']}");


				$this->model_orders->injectModels([
					'model_notification' => $this->model_notification
				]);
				$this->model_orders->updateDeliveryStatus($_fillables['status'], $delivery_data['order_id']);
			}

			return $res;
		}

		public function getComplete($id)
		{
			$delivery = parent::getRow(['id' => $id]);
			$order = $this->model_order->getOrderWithItems($delivery['order_id']);
			
			$delivery['order'] = $order;
			$delivery['order']['items'] = $order['items'];
			
			return $delivery;
		}


		public function getByOrder($order_id)
		{
			return $this->getAll([
				'where' => ['delivery.order_id' => $order_id]
			])[0] ?? false;
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			return $this->queryResultArray(
				"SELECT delivery.* , bill_no
					FROM {$this->_table_name} as delivery
					LEFT JOIN orders  
					ON orders.id = delivery.order_id
					{$where} {$order}"
			);
		}

		public function reference()
		{
			return strtoupper('DLVRY-'.generateRandomString(8));
		}

		public function updateStatus($status_data , $id)
		{
			$_fillables = $this->getFillablesOnly($status_data);

			$delivery = $this->getRow(['id' => $id]);
			//update orders
			$res = parent::update($_fillables , $id);

			if($res) 
			{	
				$this->order_id = $delivery['order_id'];
				
				$delivery = parent::get($id);

				$this->model_order->injectModels([
						'model_notification' => $this->model_notification
				]);
				$this->model_order->updateDeliveryStatus($_fillables['status'], $delivery['order_id']);
			}

			return true;
		}
	}