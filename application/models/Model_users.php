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
			'toc_agreed',
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

			$user_id = parent::create($_fillables);

			$this->registration_verification_model->create([
				'user_id' => $user_id ,
				'email'  => $user_data['email'],
				'notify_model' => $this->model_notification
			]);

			

			return $user_id;
		}

		public function sendEmailVerification($user_id)
		{
			$user = $this->getUserData($user_id);

			$this->model_notification->create_system("Thank you for registering {$user['email']} ", 
				[$user_id]);

			$this->model_notification->message_operations("{$user['email']} has registered on our system");

			$link = 'https://e-kahon.store';

			$link = $link.'/users/validateAccount?email='.$user['email'];

			$html = <<<EOF
				<h4>You are almost there</h4>
				<p>Enjoy your shopping , by verifying your account</p>
				<p>Click this <a href='{$link}'>Link</a> To Activate your account  </p>
			EOF;
			
			$this->model_notification->create_email("Activate your account " , $html , [$user['email']]);
		}




		public function update($user_data , $id)
		{
			$_fillables = $this->getFillablesOnly($user_data);

			$password = $_fillables['password'] ?? '';

			if( !empty($password) ){
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
				return $this->getAll([
					'where' => 'id = '.$id
				])[0] ?? false;

			return $this->getAll();
		}

		public function countTotalUsers()
		{
			return parent::queryResultSingle(
				"SELECT count(id) as total
					FROM {$this->_table_name}"
			)['total'] ?? 0;
		}

		public function verifyAccountByEmail($email)
		{
			$user = $this->getAll([
				'where' => " email = '{$email}' "
			])[0];

			if( !$user ){
				$this->addError("User not found");
				return false;
			}

			$is_ok = parent::update([
				'is_verified' => true				
			] , $user['id']);

			if( $is_ok ){
				$this->addMessage("Account Verified");
			}else{
				$this->addError("Account failed to verified");
			}

			return $is_ok;
		}
	}