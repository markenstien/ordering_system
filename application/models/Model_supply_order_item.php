<?php 

	class Model_supply_order_item extends Model_adapter
	{
		public $_table_name = 'supply_order_items';

		public $supply_order_id = null;


		public $_fillables = [
			'id' , 'supply_order_id' , 'quantity' , 'supplier_price'
		];

		public function addItem($supply_order_id , $item_data)
		{
			$res = $this->create([
				'supply_order_id' => $supply_order_id,
				'product_id'  => $item_data['product_id'],
				'quantity'    => $item_data['quantity'],
				'supplier_price' => $item_data['supplier_price']
			]);


			return $res;
		}

		public function getByOrder( $id )
		{
			$items = $this->getAll([
				'where' => [
					'supply_order_id' => $id
				]
			]);

			return $items;
		}		

		public function getAll($params = [])
		{
			$where = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert( $params['where'] );

			$sql = "SELECT p.* , soi.supply_order_id , soi.quantity , soi.supplier_price,
					soi.damaged_quantity, soi.damage_notes,
					soi.created_at , soi.created_by, soi.id as id,
					p.id as product_id

					FROM {$this->_table_name} as soi 
					LEFT JOIN products as p 
					ON p.id = soi.product_id
					{$where}";

			return $this->queryResultArray( $sql );
		}
		public function deleteCustom($id)
		{
			$item = $this->get($id);

			$this->supply_order_id = $item['supply_order_id'];

			return $this->delete($id);
		}

		public function updateCustom($data , $id)
		{
			$item = $this->get( $id );
			
			$_fillables = $this->getFillablesOnly($data);

			$this->supply_order_id = $item['supply_order_id'];

			return $this->update($_fillables , $id);
		}
	}