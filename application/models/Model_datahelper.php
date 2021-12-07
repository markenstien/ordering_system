<?php 

	class Model_datahelper
	{	

		protected $ci;

		protected $database;

		public function __construct()
		{
			$this->ci = new CI_Model();
			$this->database = $this->ci->db;
		}
		public function dbinsert($tableName , $fieldsAndValues)
		{
			$fields = array_keys($fieldsAndValues);

			$values = array_values($fieldsAndValues);

			$cleansedValues = [] ;
			$retunData = [];

			foreach($values as $key => $val) {

				$cleansedValues[] = str_escape($val , FILTER_SANITIZE_STRING);

			}

			foreach($fields as $key => $field) {

				$retunData[$field] = $cleansedValues[$key]; 
			}


			$sql = "INSERT INTO $tableName(".implode(",", $fields).")
				VALUES('".implode("','", $cleansedValues)."')";
				
			$update = $this->ci->db->query($sql);

			return $this->ci->db->insert_id();
		}

		public function dbupdate($tableName , $fieldsAndValues , $where = null)
		{
			$fields = array_keys($fieldsAndValues);

			$values = array_values($fieldsAndValues);

			$cleansedValues = [] ;

			$retunData = [];

			foreach($values as $key => $val) {

				$cleansedValues[] = str_escape($val , FILTER_SANITIZE_STRING);

			}

			foreach($fields as $key => $field) {

				$retunData[$field] = $cleansedValues[$key]; 
			}

			$sql = " UPDATE $tableName set ";

			$count = 0;
			
			foreach($fields as $key => $field) {

				if($count < $key) {
					$sql .=',';
					$count++;
				}

				$sql .= " {$field} = '{$cleansedValues[$key]}' ";
			}

			if($where != null) {
				$sql .= " WHERE $where";
			}

			$update = $this->ci->db->query($sql);
			return ($update == true) ? true : false;
		}

		public function dbdelete($tableName , $where)
		{
			$sql = "DELETE FROM $tableName WHERE {$where}";
			$delete = $this->ci->db->query($sql);
			return ($delete == true) ? true : false;
		}

		private final function dbselect( $tableName , $condition = null, $fields = '*' ,  $orderby= null , $limit = null , $offset = null)
		{
			if(is_array($fields))
			{
				$sql = "SELECT  ".implode(',',$fields)." from $tableName";
			}else{
				$sql = "SELECT $fields from $tableName";
			}

			if(! is_null($condition)) {

				$sql .= " WHERE $condition ";
			}

			if(!is_null($orderby)) {
				$sql .= " ORDER BY $orderby";
			}

			if(!is_null($limit) && is_null($offset)) {
				$sql .= " LIMIT $limit";
			}

			if(!is_null($offset) && is_null($limit))
			{
				$sql .= " offset $offset";
			}

			if(!is_null($offset) && !is_null($limit))
			{
				$sql .= " LIMIT $offset , $limit";
			}

			return $sql;
		}

		public function dbresultSet($tableName , $condition = null, $fields = '*' , $orderby= null ,  $limit = null , $offset = null)
		{
			$sql = $this->dbselect($tableName , $condition , $orderby , $fields , $limit , $offset);

			$query = $this->ci->db->query($sql);

			return $query->result_array();
		}

		public function dbrow($tableName , $condition = '*' , $fields = '*', $orderby = null)
		{

			$sql = $this->dbselect($tableName , $condition , $fields, $orderby);
			
			$query = $this->ci->db->query($sql);
			return $query->row_array();
		}
	}