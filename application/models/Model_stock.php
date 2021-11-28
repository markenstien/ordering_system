<?php 

	class Model_stock extends Model_adapter
	{
		public $_table_name = 'stocks';

		public $_fillables = [
			'id' , 'product_id',
			'quantity' , 'description',
			'created_by', 'created_at',
			'purchase_order_id','date'
		];
		
		public function addStock( $stock_data )
		{		
			$quantity = abs($stock_data['quantity']);

			if( isEqual($stock_data['type'] , 'deduct') )
				$quantity *= -1;

			$_fillables = $this->getFillablesOnly($stock_data);

			$_fillables['quantity'] = $quantity;

			return $this->create($_fillables);
		}
	}