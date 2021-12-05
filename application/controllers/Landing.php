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


			if( isset($_GET['key_word']) )
			{
				$key_word = $_GET['key_word'];

				$this->data['products'] = $this->model_products->getAll([
					'where' => [
						'name' => [
							'condition' => 'like',
							'value'  => "%{$key_word}%",
							'concatinator' => ' OR '
						],

						'category_id' => [
							'condition' => 'in',
							'value'  => [$key_word]
						]
					]
				]);
			}else
			{
				$this->data['products'] = $this->model_products->getAll();
			}

			$this->data['bundles']  = $this->model_product_bundle->getAllWithItems();

			return $this->view_public('landing/index' , $this->data);
		}

		public function catalog()
		{
			
		}
	}