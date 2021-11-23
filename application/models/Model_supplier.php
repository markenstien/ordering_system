<?php 

class Model_supplier extends CI_Model
{	
	public $_fillables = [];

	public function __construct()
	{
		parent::__construct();
	}


	public function create($data)
	{
		$allowed_fields = [
			'name',
			'product',
			'phone',
			'email',
			'contact_name',
			'website',
		];

		if($data) 
		{
			$dataToInsert = [];
				

			foreach($allowed_fields as $field) {
				$dataToInsert[$field] = $data[$field];
			}

			$insert = $this->db->insert('suppliers', $dataToInsert);
			return ($insert == true) ? true : false;
		}
	}
}