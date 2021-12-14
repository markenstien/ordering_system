<?php 
	
	class ReturnProcess extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_return_process');
		}

		public function update()
		{
			$post = $_POST;
			
			$this->model_return_process->update($post['text_content'] , $post['id']);
			flash_set('Return Process Updated');

			return redirect('returnOrder/show/'.$post['return_id']);
		}
	}