<?php 

	class Model_payment extends Model_adapter
	{
		public $_table_name = 'payments';

		public $_fillables = [
			'id' , 'reference','amount',
			'method' , 'notes', 'org',
			'external_reference' , 'acc_no',
			'acc_name' , 'order_id' , 'created_by'
		];

		public function createPayment($payment_data)
		{
			$_fillables = $this->getFillablesOnly($payment_data);

			$res = $this->create($_fillables);

			if($res) {
				//pdate order
				$this->dbupdate('orders', ['paid_status' => 1], $this->conditionConvert(['id' => $payment_data['order_id']]));
			}

			return $res;
		}
	}