<?php 	

class Model_adapter extends Model_datahelper
{

	protected static $MESSAGE_UPDATE_SUCCESS = "UPDATED SUCCESFULLY";
	protected static $MESSAGE_CREATE_SUCCESS = "CREATED SUCCESFULLY";
	protected static $MESSAGE_DELETE_SUCCESS = "DELETED SUCCESFULLY";

	public $_table_name;
	public $_order_by;
	public $_primary_key;

	public $_messages = [];
	public $_errors = [];

	public function __construct()
	{
		parent::__construct();
	}


	public function queryResultArray($sql)
	{
		$query = $this->ci->db->query($sql);
		return $query->result_array();
	}

	public function queryResultSingle($sql)
	{
		$query = $this->ci->db->query($sql);
		return $query->row_array();
	}
	public function get($id)
	{
		return $this->dbrow( $this->_table_name , $this->conditionConvert(['id' => $id]));
	}

	public function getRow($condition , $orderby = null)
	{
		return $this->dbrow($this->_table_name, $this->conditionConvert($condition) );
	}

	public function getRowArray($condition = null, $fields = '*' , $orderby= null , $limit = null , $offset = null)
	{
		return $this->dbresultSet($this->_table_name, $this->conditionConvert($condition) , $orderby , $fields , $limit , $offset );
	}

	public function delete($id)
	{
		return $this->dbdelete( $this->_table_name , $this->conditionConvert(['id' => $id]) );
	}

	public function deleteKeyPair($keyPair = [])
	{
		return $this->dbdelete( $this->_table_name , $this->conditionConvert($keyPair));
	}

	public function update($data , $id)
	{
		return $this->dbupdate( $this->_table_name , $data , $this->conditionConvert(['id' => $id]));
	}

	public function create($data)
	{
		return $this->dbinsert($this->_table_name, $data);
	}

	public function conditionConvert($params = null ,$defaultCondition = '=')
	{	

		if( is_null($params))
			return null;

		$WHERE = '';
		$counter = 0;

		$errors = [];

		/*
		*convert-where default concatinator is and
		*add concat on param values to use it
		*/
		$condition_operation_concatinator = 'AND';

		foreach($params as $key => $param_value) 
		{	
			if( $counter > 0)
				$WHERE .= " {$condition_operation_concatinator} "; //add space

			/*should have a condition*/
			if( is_array($param_value) && isset($param_value['condition']) ) 
			{
				$condition_operation_concatinator = $param_value['concatinator'] ?? $condition_operation_concatinator;

				//check for what condition operation
				$condition = $param_value['condition'];
				$condition_values = $param_value['value'];

				if( isEqual($condition , ['between' , 'not between']))
				{
					if( !is_array($condition_values) )
						return _error(["Invalid query" , $params]);
					if( count($condition_values) < 2 )
						return _error("Incorrect between condition");

					$condition = strtoupper($condition);

					list($valueA, $valueB) = $condition_values;
						$WHERE .= " {$key} {$condition} '{$valueA}' AND '{$valueB}'";
				}

				if( isEqual($condition , ['equal' , 'not equal' , 'in']) )
				{
					$conditionKeySign = '=';

					if( isEqual($condition , 'not equal') )
						$conditionKeySign = '!=';

					if( isEqual( $condition , 'in'))
						$conditionKeySign = ' IN ';

					if( is_array($condition_values) )
					{
						$WHERE .= "{$key} $conditionKeySign ('".implode("','",$condition_values)."') ";
						// $WHERE .= "{$key} {$conditionKeySign} '".implode("','",$condition_values)."'";
					}else
					{
						$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}' ";
					}
				}

				/*
				*if using like
				*add '%' on value 
				*/
				if( isEqual($condition , 'like') )
				{
					$conditionKeySign = 'like';
					$WHERE .= "{$key} {$conditionKeySign} '{$condition_values}'";
				}

				$counter++;

				continue;
			}

			if( isEqual($defaultCondition , 'like')) 
				$WHERE .= " $key {$defaultCondition} '%{$param_value}%'";

			if( isEqual($defaultCondition , '=')) 
			{
				$isNotCondition = substr( $param_value , 0 ,1); //get exlamation
				$isNotCondition = stripos($isNotCondition , '!');

				if( $isNotCondition === FALSE )
				{
					$WHERE .= " $key = '{$param_value}'";
				}else{
					
					$cleanRow = substr($param_value , 1);

					$WHERE .= " $key != '{$cleanRow}'";
				}
			}

			$counter++;
		}

		// dump($WHERE);


		return $WHERE;
	}
		
	public function getFillablesOnly($datas = [])
	{
		if( empty($datas) )
			return false;
		
		$return = [];

		foreach($datas as $key => $row) {
			if( isEqual($key, $this->_fillables) )
				$return[$key] = $row;
		}
		return $return;
	}	

	public function addMessage($message)
	{
		array_push($this->_messages, $message);
	}

	public function getMessages()
	{
		return $this->_messages;
	}

	public function getMessageString()
	{
		$html = '';

		foreach ($this->_messages as $message){
			$html.= "<div>{$message}</div>";
		}

		return $html;
	}

	public function addError($error){
		array_push( $this->_errors , $error);
	}

	public function getErrors()
	{
		return $this->_errors;
	}

	public function getErrorString()
	{
		$html = '';

		foreach ($this->_errors as $error){
			$html.= "<div>{$error}</div>";
		}

		return $html;
	}

	public function injectModels($models = [] ){

		foreach($models as $model_name => $model) {
			$this->$model_name = $model;
		}
	}
}