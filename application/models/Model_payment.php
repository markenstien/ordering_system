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
				$this->model_stock->addStock([
					'quantity' => $row['quantity'],
					'type'    => 'deduct',
					'product_id' => $row['product_id'],
					'date'     => $date,
					'description' => " ORDERS FROM {$bill_no}"
				]);
			}

			return $payment_id;
		}

		public function createPayment($payment_data)
		{
			$_fillables = $this->getFillablesOnly($payment_data);
			$_fillables['reference'] = $this->getRefence();

			$res = $this->create($_fillables);

			if($res) {
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