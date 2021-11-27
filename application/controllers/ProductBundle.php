<?php 

	class ProductBundle extends Admin_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'Product Bundling';

			$this->load->model('model_product_bundle');
		}

		public function create()
		{
			if( isSubmitted() )
			{
				$this->model_product_bundle->create($_POST);
			}

			return $this->render_template('product_bundle/create' , $this->data);
		}

		public function index()
		{
			$this->data['product_bundles'] = $this->model_product_bundle->getRowArray();

			return $this->render_template('product_bundle/index' , $this->data);
		}
	}