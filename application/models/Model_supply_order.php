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
			'budget',
			'reference'
		];


		public function __construct()
		{
			parent::__construct();
		}

		public function create( $data )
		{
			$_fillables = $this->getFillablesOnly($data);

			$_fillables['reference'] = $this->generateReference();

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

		public function migrateToStocks($id)
		{
			$migrated = false;

			$supply_order = $this->get($id);

			//injected model
			$items = $this->model_supply_order_item->getByOrder($id);

			if(!$items){
				$this->addError("No Items to be migrated!");
				return false;
			}

			foreach($items as $item) 
			{
				$stock_added = $this->model_stock->addStock([
					'product_id' => $item['id'],
					'quantity'   => $item['quantity'],
					'description' => 'From Supply Order #'.$supply_order['reference'],
					'type'  => 'add',
					'purchase_order_id' => $supply_order['id'],
					'date' => $supply_order['date']
				]);

				$migrated = $stock_added;
			}

			if(!$migrated) {
				$this->addError("Unable to migrate items");
				return false;
			}

			$this->update([
				'status' => 'delivered'
			], $id );

			$this->addMessage("Stocks added!");
			return true;
		}

		public function generateReference()
		{
			return strtoupper(generateRandomString(12));
		}
	}