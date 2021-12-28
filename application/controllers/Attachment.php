<?php 

	class Attachment extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_attachment');
			$this->load->library('user_agent');
		}


		public function delete( $id )
		{
			$this->model_attachment->delete( $id );
			flash_set('Attachment deleted');
			return redirect( $this->agent->referrer() );
		}
	}