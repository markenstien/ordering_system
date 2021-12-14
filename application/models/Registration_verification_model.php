<?php

	class Registration_verification_model extends Model_adapter
	{
		public $_table_name = 'registration_verifications';

		public $_fillables = [
			'email' , 'user_id',
			'code' , 'status'
		];

		public function create( $code_data )
		{
			$_fillables = $this->getFillablesOnly($code_data);

			$this->code = $this->generateCode();

			$_fillables['code'] = $this->code;

			if( isset($code_data['notify_model']) )
			{
				//notify via email
				$code_data['notify_model']->create_email("Activate your Account","Thank you for registering to activate use this activation code
						to activate your account <b>{$this->code}</b> ");
			}

			return parent::create($_fillables);
		}

		//generate code

		public function generateCode()
		{
			return strtoupper(generateRandomString(4));
		}
	}