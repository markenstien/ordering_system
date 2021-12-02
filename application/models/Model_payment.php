<?php 

	class Model_payment extends Model_adapter
	{
		public $_table_name = 'payments';

		public $_fillables = [
			'id' , 'reference','amount',
			'method' , 'notes', 'org',
			'external_reference' , 'acc_no',
			'acc_name' , 'bill_id' , 'created_by'
		];

		public function createPayment($payment_data)
		{

			$_fillables = $this->getFillablesOnly($payment_data);

			return $this->create($_fillables);
		}
	}