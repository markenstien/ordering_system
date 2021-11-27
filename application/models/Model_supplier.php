<?php 
	
	class Model_supplier extends Model_adapter
	{	
		public $_table_name = 'suppliers';


		public $_fillables = [
			'name' , 'product',
			'phone' , 'email',
			'contact_name' , 'website'
		];

		public function getAll($where = [])
		{
			return $this->getRowArray();
		}

		public function update($data , $id)
		{
			$_fillables = $this->getFillablesOnly($data);
			
			return parent::update($_fillables , $id);
		}

		public function create($data)
		{
			$_fillables = $this->getFillablesOnly($data);

			return parent::create($_fillables);
		}
	}