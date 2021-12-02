<?php 

	class Landing extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = ' Products ';

			$this->load->model('model_products');
			$this->load->model('model_product_bundle');
			$this->load->model('model_product_bundle_item');
		}

		public function index()
		{	

			$this->model_product_bundle->injectModels([
				'model_bundle_item' => $this->model_product_bundle_item
			]);

			$this->data['products'] = $this->model_products->getAll();

			$this->data['bundles']  = $this->model_product_bundle->getAllWithItems();


			return $this->view_public('landing/index' , $this->data);
		}

		public function catalog()
		{
			
		}
	}