<?php 

	class Model_supply_order_item extends Model_adapter
	{
		public $_table_name = 'supply_order_items';

		public function addItem($supply_order_id , $item_data)
		{
			$res = $this->create([
				'supply_order_id' => $supply_order_id,
				'product_id'  => $item_data['product_id'],
				'quantity'    => $item_data['quantity']
			]);


			return $res;
		}

		public function getByOrder( $id )
		{
			$items = $this->getAll([
				'supply_order_id' => $id
			]);

			return $items;
		}		

		public function getAll($params = [])
		{
			$where = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert( $params['where'] );

			$sql = "SELECT p.* , soi.supply_order_id , soi.quantity , 
					soi.damaged_quantity, soi.damage_notes,
					soi.created_at , soi.created_by

					FROM {$this->_table_name} as soi 
					LEFT JOIN products as p 
					ON p.id = soi.product_id
					{$where}";

			return $this->queryResultArray( $sql );
		}
	}