<?php 

	class About extends Admin_Controller
	{
		public function index()
		{
			$data = [
				'page_title' => 'About the Team',
			];

			$data = array_merge($data , $this->data);

			return $this->view_public('about/index' , $data);
		}
	}