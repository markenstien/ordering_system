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


		public function update( $stock_data , $id = null)
		{
			$quantity = abs($stock_data['quantity']);

			if( isEqual($stock_data['type'] , 'deduct') )
				$quantity *= -1;

			$_fillables = $this->getFillablesOnly($stock_data);

			$_fillables['quantity'] = $quantity;

			return parent::update($_fillables , $id);
		}

		public function canSupplyOrderQuantity($product_id , $quantity)
		{
			$total_stock = parent::queryResultSingle(
				"SELECT sum(quantity) as total_stock
					FROM {$this->_table_name} 
					WHERE product_id = '{$product_id}' "
			);

			if( $total_stock->total_stock ?? 0 < $quantity){
				$this->addError("Not enough stocks for your orders");
				return false;
			}

			return true;
		}

		public function getAll( $params = [])
		{
			$where = null;
			$order = null;


			if( isset($params['where']) )
				$where = " WHERE " .$this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			$sql = "SELECT stock.* , product.name as product_name 
					FROM {$this->_table_name} as stock 
					LEFT JOIN products as product 
					ON product.id = stock.product_id
					{$where} {$order}";

			return $this->queryResultArray($sql);
		}

		public function getReportGroupProduct($params = [])
		{
			$sql = "SELECT sum(quantity) as total_stock  , 
					product.name as product_name, product.id as product_id,
					product.min_stock as min_stock , product.max_stock as max_stock
					FROM {$this->_table_name} as stock

					LEFT JOIN products as product 
					ON product.id = stock.product_id
					GROUP BY stock.product_id";

			//not ideal but will do the job
			$results = $this->queryResultArray($sql);

			$ret_val = [];

			foreach($results as $key => $row) 
			{
				$new_val = $row;
				$new_val['remarks'] = '';
				
				if( $row['total_stock'] <= $row['min_stock']) {
					$new_val['remarks'] = " Running low on stocks "; 
				}else if($row['total_stock'] >= $row['max_stock']){
					$new_val['remarks'] = " Too much stocks "; 
				}else
				{
					$new_val['remarks'] = " Good ";
				}
				$ret_val[] = $new_val;
			}

			return $ret_val;
		}
	}