<?php 

	class Model_product_bundle_item extends Model_adapter
	{
		public $_table_name = 'product_bundle_items';

		public $_fillables = [
			'id' , 'product_id' , 'bundle_id' , 'quantity'
		];

		public function getByBundle($bundle_id)
		{
			return $this->getAll([
				'where' => [
					'pdi.bundle_id' => $bundle_id
				]
			]);
		}

		public function getAll($params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE " . $this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY " .$params['order'];

			return $this->queryResultArray(
				"SELECT product.* ,product.name as product_name, 
					pdi.id as id , 
					pdi.bundle_id as bundle_id,
					pdi.product_id as product_id,
					pdi.quantity as quantity,
					stock.stocks as stocks

				 	FROM {$this->_table_name} as pdi

					LEFT JOIN products as product
					ON product.id = pdi.product_id

					LEFT JOIN (SELECT ifnull(sum(quantity) , 0) as stocks , product_id FROM stocks GROUP BY product_id) as stock 
					ON product.id = stock.product_id
					{$where} {$order}"
			);
		}

		public function add($bundle_item_data)
		{
			$_fillables = $this->getFillablesOnly($bundle_item_data);

			if(  $this->getByProduct($bundle_item_data['product_id']) ){
				$this->addError("Product Already exists");
				return false;
			}
			//check if product-already existed 
			return $this->create( $_fillables );
		}

		public function getByProduct($product_id)
		{
			return $this->getRow(['product_id' => $product_id]);
		} 


		public function deleteCustom($id)
		{
			$item = $this->get($id);
			$this->bundle_id = $item['bundle_id'];
			$this->delete($id);
		}
	}