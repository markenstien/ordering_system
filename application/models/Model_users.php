<?php 

	class Model_users extends Model_adapter
	{
		public $_table_name = 'users';

		public $_fillables = [
			'id',
			'username',
			'password',
			'email',
			'firstname',
			'lastname', 
			'phone' ,
			'gender',
			'user_type', 
			'is_verified',
			'address'
		];

		public function create($user_data)
		{
			$_fillables = $this->getFillablesOnly($user_data);

			if( isset( $_fillables['password'] ))
				$_fillables['password'] = $this->password_hash($_fillables['password']);


			//check if username already exists and email

			if( $this->getByKey('username' , $_fillables['username'] ) ){
				$this->addError("Username already exists please user anotherone, account create failed");
				return false;
			}

			if( $this->getByKey('email' , $_fillables['email'] ) ){
				$this->addError("Email already exists please user anotherone, account create failed");
				return false;
			}

			return parent::create($_fillables);
		}

		public function update($user_data , $id)
		{
			$_fillables = $this->getFillablesOnly($user_data);

			if( empty($_fillables['password']) ){
				unset($_fillables['password']);
			}else{
				$_fillables['password'] = $this->password_hash($_fillables['password']);
			}

			//reset auth mo
			$res = parent::update($_fillables , $id);

			if($res) {
				$this->login = parent::get($id);
			}
			return $res;
		}
		public function password_hash( $password )
		{
			$password = password_hash($password, PASSWORD_DEFAULT);
			return $password;
		}

		public function getByKey($key , $value)
		{
			return parent::getRowArray(["{$key}" => $value]);
		}

		public function getAll( $params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert( $params['where'] );

			if( isset($params['order']) )
				$order = " ORDER BY ".$params['order'];


			return $this->queryResultArray(
				"SELECT * ,
					CASE WHEN is_verified = true THEN 'verified'
						ELSE 'unverified' END as verification_status

					FROM {$this->_table_name}
					{$where} {$order}"
			);
		}

		public function getUserData($id)
		{
			if( $id )
				return $this->getAll($id)[0];

			return $this->getAll();
		}

		public function countTotalUsers()
		{
			return parent::queryResultSingle(
				"SELECT count(id) as total
					FROM {$this->_table_name}"
			)['total'] ?? 0;
		}
	}