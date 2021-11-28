<?php 

	class Model_product_bundle extends Model_adapter
	{
		public $_table_name = 'product_bundles';

		public $_fillables = [
			'name',
			'description',
			'price',
			'price_custom',
			'discount',
			'status',
			'created_by'
		];

		public function __construct()
		{
			parent::__construct();
		}

		public function create($data)
		{
			$_fillables = $this->getFillablesOnly($data);

			return parent::create($_fillables);
		}

		public function get($id)
		{
			return $this->getAll([
				'where' => [
					'id' => $id
				]
			])[0] ?? false;
		}

		public function getAll( $params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE " . $this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY " .$params['order'];

			return $this->queryResultArray(
				"SELECT *,
					CASE 
						WHEN price_custom = 0.0 THEN price
						WHEN price_custom != 0 THEN price_custom
						ELSE price_custom end as price_public
						FROM {$this->_table_name}

					{$where} {$order}
				"
			);
		}

		public function update($product_bundle_data , $id)
		{
			$_fillables = $this->getFillablesOnly($product_bundle_data , $id);

			return parent::update($_fillables , $id);
		}

		public function updateRealTimePrice( $id )
		{	
			$total_amount = 0;

			$products = $this->model_bundle_items->getByBundle($id);

			foreach($products as $product) {
				$total_amount += $product['price'];
			}

			$this->update(['price' => $total_amount] , $id);
		}

		public function removePublicPrice( $id )
		{
			$this->update([
				'price_custom' => 0
			] , $id);

			$this->updateRealTimePrice($id);

			return true;
		}
	}