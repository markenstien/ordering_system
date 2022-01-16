<?php 

	class Model_payment_gcash extends Model_adapter
	{
		public $_table_name = 'payment_gcash';

		public function createWithImage( $payment_data , $image_src )
		{
			extract($payment_data);

			$reference  = strtoupper(generateRandomString(12));

			if( floatval($amount) != floatval($amount_paid)){
				$this->addError("Invalid Amount , Does not match net amount total");
				return false;
			}

			return parent::create([
				'order_id' => $order_id,
				'reference' => $reference,
				'account_name' => $account_name,
				'account_number' => $account_number,
				'reference_number' => $reference_number,
				'amount_paid' => $amount_paid,
				'image_src' => $image_src,
				'user_id'   => $user_id ?? 0,
			]);
		}

		public function updateWithImage($payment_data , $id , $image)
		{
			extract($payment_data);

			if( floatval($amount) != floatval($amount_paid)){
				$this->addError("Invalid Amount , Does not match net amount total");
				return false;
			}

			$data_to_update = [
				'order_id' => $order_id,
				'account_name' => $account_name,
				'account_number' => $account_number,
				'reference_number' => $reference_number,
				'amount_paid' => $amount_paid,
			];

			if( !empty($image) ){
				$data_to_update['image_src'] = $image_src;
			}

			return parent::update( $data_to_update , $id);
		}

		public function validOrInvalid($id , $status)
		{	
			$gcash = $this->get($id);

			$res = parent::update([
				'validation_status' => $status
			] , $id);

			$href = '/orders/show/'.$gcash['order_id'];


			if( isEqual($status , 'valid') )
			{
				// insert payment to database

				$res = $this->model_payment->createPayment([
					'amount' => $gcash['amount_paid'],
					'method' => 'online',
					'notes'  => 'Paid Via Gcash - Payment Attachment',
					'org' => 'GCASH',
					'external_reference' => $gcash['reference_number'],
					'acc_name' => $gcash['account_name'],
					'acc_no'   => $gcash['account_number'],
					'order_id' => $gcash['order_id'],
					'user_id'=> $gcash['user_id']
				]);

				return $res;
			}

			if($res) 
			{
				$this->model_notification->create_system(
					"Your GCASH-Payment has been {$status}, Reference:#{$gcash['reference']}",
					[$gcash['user_id']],
					['href' => $href]
				);

				$this->model_notification->message_operations(
					"GCASH-Payment has been {$status},
						Reference:#{$gcash['reference']}",
					['href' => $href]
				);
			}

			return $res;
		}
			
		public function getByOrder($order_id)
		{
			return parent::getRow([
				'order_id' => $order_id
			],'id desc');
		}

		public function edit($id)
		{

		}

		/*
		*payment is only deleted if its still on pending
		*and logged in user is the owner
		*/
		public function delete($id)
		{
			return parent::delete($id);
		}
	}