<?php 

	class Model_notification extends CI_Model
	{	

		public function __construct()
		{
			parent::__construct();

			$config = [
				'protocol' => 'email',
				'smtp_host' => 'e-kahon.store',
				'smtp_port' => '465',
				'smtp_user' => 'super@e-kahon.store',
				'smtp_pass' => '@TdDk&S^YA}I',
				'mailtype'  => 'html',
				'wordwrap'  => TRUE
			]; 

			$this->load->library('email' , $config);
		}


		public function create_with_operations($user_message , $operation_message , $recipient = [])
		{
			$this->create($user_message , $recipient);


		}

		public function create_email( $subject, $message , $emails = [])
		{
			$this->email->from('super@e-kahon.store', 'E-Kahon');

			$this->email->to($emails);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');

			$this->email->subject($subject);
			$this->email->message($message);

			$this->email->send();
		}

		/*
		*sms
		*system
		*email
		*/
		public function create_multiple_gateway( $message , $recipients_gateway , $attributes = [])
		{
			$system_recipients = $recipients_gateway['system'] ?? [];
			$sms_recipients = $recipients_gateway['sms'] ?? [];
			$email_recipients = $recipients_gateway['email'] ?? [];

			if( $system_recipients )
				$this->create_system( $message , $system_recipients , $attributes);

			if( $sms_recipients )
				send_sms( $message , $sms_recipients);


			return true;
		}

		public function create_system( $message , $recipientIds , $attributes = [])
		{
			if( !is_array($recipientIds) || empty($recipientIds) )
			{ echo die("Recipients must be array"); }

			$icon = $attributes['icon'] ?? '';
			$color = $attributes['color'] ?? '';
			$heading = $attributes['heading'] ?? '';
			$subtext = $attributes['subtext'] ?? '';
			$href = $attributes['href'] ?? '';


			$message = str_escape($message , FILTER_SANITIZE_STRING);

			$is_ok = $this->db->insert('system_notifications' , [
				'message' => $message,
				'icon'    => $icon,
				'color'   => $color,
				'heading' => $heading,
				'subtext' => $subtext,
				'href'    => $href
			]);




			if($is_ok)
			{
				$notification_id = $this->db->insert_id();

				$sql = " INSERT INTO system_notification_recipients(notification_id , recipient_id , is_read) VALUES ";

				foreach($recipientIds as $index => $id) 
				{
					if( $index > 0){
						$sql .= ' , ';
					}
					$sql .= "('{$notification_id}' , '{$id}' , false) ";
				}

				return $this->db->query($sql);
			}else{
				Flash::set("Error to save notification" , 'danger');
				return false;
			}
		}

		public function operations_ids()
		{
			$user_ids = [];

			$query = $this->db->query(
				"SELECT * FROM users 
					WHERE user_type in ('admin' , 'employee') "
			);

			$users = $query->result_array();

			foreach($users as $key => $user) {
				$user_ids[] = $user['id'];
			}

			return $user_ids;
		}

		public function message_operations( $message , $attributes = [])
		{
			$operations_ids = $this->operations_ids();

			$this->create_system( $message , $operations_ids , $attributes );
		}

		public function getNotifications( $user_id = null )
		{
			$ret_val = [];

			if( ! is_null($user_id) )
			{
				$query = $this->db->query(
					"SELECT sn.* FROM system_notifications as sn 
						LEFT JOIN system_notification_recipients as snr 
						ON sn.id = snr.notification_id

						where snr.recipient_id = '{$user_id}'
						order by sn.id desc"
				);

				$ret_val = $query->result_array();
			}else
			{
				$ops_ids = $this->operations_ids();

				$query =  $ret_val = $this->db->query(
					"SELECT sn.* FROM system_notifications as sn 
						LEFT JOIN system_notification_recipients as snr 
						ON sn.id = snr.notification_id
					where snr.recipient_id in '(".implode("','" , $ops_ids).")'
					order by sn.id desc"
				);
				$ret_val = $query->result_array();
			}

			return $ret_val;
		}
	}