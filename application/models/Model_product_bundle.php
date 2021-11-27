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
	}