<?php 	

	class Model_supply_order extends Model_adapter
	{
		public $_table_name = 'supply_orders';

		public $_fillables = [
			'supplier_id',
			'date',
			'amount',
			'balance',
			'status',
			'payment_status',
			'description',
			'title',
			'budget'
		];


		public function __construct()
		{
			parent::__construct();
		}

		public function create( $data )
		{
			$_fillables = $this->getFillablesOnly($data);

			return parent::create($_fillables);
		}


		public function update($data , $id)
		{
			$_fillables = $this->getFillablesOnly($data);

			return parent::update($_fillables , $id);
		}
		
		public function getAll( $params = [])
		{
			$where = null;

			if( isset($params['where']) )
				$where =  " WHERE " .$this->conditionConvert( $params['where'] ) ;

			return $this->queryResultArray(
				"SELECT supply_order.* , sup.name as supplier 
					FROM {$this->_table_name} as supply_order
					LEFT JOIN suppliers as sup
					ON sup.id = supply_order.supplier_id
					{$where}"
			);
		}

		public function get($id)
		{
			$order = $this->getAll([
				'where' => [
					'supply_order.id' => $id
				]
			]);

			return $order[0] ?? false;
		}
	}

