<?php 

	class Bundles extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_product_bundle');
			$this->load->model('Model_product_bundle_item');

			$this->model_product_bundle->injectModels([
				'model_bundle_item' => $this->Model_product_bundle_item
			]);
		}

		public function index()
		{
			$bundles = $this->model_product_bundle->getAllWithItems();

			$data = [
				'title' => 'Product Bundles',
				'bundles' => $bundles
			];

			$this->data = array_merge($data , $this->data);

			return $this->view_public('bundle/index' , $this->data);
		}

		public function order()
		{
			$bundle_id = $_POST['bundle_id'];

			$bundle = $this->model_product_bundle->getAllWithItems([
				'where' => ['id' => $bundle_id]
			]);


			return $this->view('');
		}
	}