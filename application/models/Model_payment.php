<?php 

	class Model_payment extends Model_adapter
	{
		public $_table_name = 'payments';

		public $_fillables = [
			'id' , 'reference','amount',
			'method' , 'notes', 'org',
			'external_reference' , 'acc_no',
			'user_id',
			'acc_name' , 'order_id' , 'created_by'
		];

		public function createAndDeductStock($payment_data)
		{
			$payment_id = parent::create($payment_data);

			$order = $this->model_orders->getOrderWithItems( $payment_data['order_id'] );

			$bill_no = $order['bill_no'];
			$date = date('Y-m-d' , $order['date_time']);

			foreach($order['items'] as $row) 
			{
				if( $row['qty'] <= 0 )
					continue;

				$this->model_stock->addStock([
					'quantity' => $row['qty'],
					'type'    => 'deduct',
					'product_id' => $row['product_id'],
					'date'     => $date,
					'description' => " ORDERS FROM {$bill_no}"
				]);
			}

			return $payment_id;
		}


		public function createBasic($payment_data)
		{
			$_fillables = $this->getFillablesOnly($payment_data);
			$_fillables['reference'] = $this->getRefence();

			$res = $this->create($_fillables);


			if( isset($_fillables['user_id']) )
			{
				$user = $this->model_user->getUserData( $_fillables['user_id'] );

				$link = '/orders/show/'.$_fillables['order_id'];

				$user_message_data = [
					"You just made a payment" , 
					"You just made a payment amounting to {$_fillables['amount']}. 
					Payment reference #{$_fillables['reference']}",
					[$user['email']],
				];

				// $this->model_notification->create_email(...$user_message_data);

				$user_message_data = [
					"You just made a payment amounting to {$_fillables['amount']}. Payment reference #{$_fillables['reference']}",
					[$user['id']],
					[
						'href' => $link
					]	
				];

				$this->model_notification->create_system(...$user_message_data);

				$this->model_notification->message_operations("{$_fillables['acc_name']} has made a payment amounting to {$_fillables['amount']} " , [
						'href' => $link
					]);
			}

			return $res;
		}
		public function createPayment($payment_data)
		{
			$res = $this->createBasic($payment_data);

			if($res) 
			{
				$order = $this->model_orders->getOrderWithItems( $payment_data['order_id'] );
				$bill_no = $order['bill_no'];
				$date = date('Y-m-d' , $order['date_time']);

				foreach($order['items'] as $row) 
				{
					if( $row['qty'] <= 0 )
						continue;

					$this->model_stock->addStock([
						'quantity' => $row['qty'],
						'type'    => 'deduct',
						'product_id' => $row['product_id'],
						'date'     => $date,
						'description' => " ORDERS FROM {$bill_no}"
					]);
				}

				//pdate order
				$this->dbupdate('orders', ['paid_status' => 1], $this->conditionConvert(['id' => $payment_data['order_id']]));
			}

			return $res;
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert( $params['where'] );
			if( isset($params['order']))
				$order = " ORDER BY ". $params['order'];

			return parent::queryResultArray(
				"SELECT payment.*, tbl_order.bill_no as bill_no 
					FROM {$this->_table_name} as payment 
					LEFT JOIN orders as tbl_order 
					ON tbl_order.id = payment.order_id
					{$where} {$order}"
			);
		}

		public function getRefence()
		{
			return strtoupper('PAYMENT-'.generateRandomString(8));
		}
	}