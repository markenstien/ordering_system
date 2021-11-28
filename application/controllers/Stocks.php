<?php

	class Stocks extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'Stocks Management';

			$this->load->model('model_stock');
			$this->load->model('model_products');

			$this->data['products'] = $this->model_products->getActiveProductData();
		}

		public function create()
		{
			if( isSubmitted() )
			{
				$post = $_POST;

				$res = $this->model_stock->addStock( $post );

				if($res) {
					flash_set("Stocks Added");
					return redirect('products');
				}

				flash_set("Stocks failed to");
			}
			return $this->render_template('stocks/create' , $this->data);
		}
	}