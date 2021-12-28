<?php 
	
	class Model_supplier extends Model_adapter
	{	
		public $_table_name = 'suppliers';


		public $_fillables = [
			'name' , 'product',
			'phone' , 'email',
			'contact_name' , 'website'
		];

		public function getAll($params = [])
		{	
			$where = null;
			$order = null;

			if( isset($params['where']) ) {
				$where = $params['where'];
			}
			if( isset($params['order']) ){
				$order = $params['order'];
			}
			
			return $this->getRowArray( $where , '*' , $order );
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