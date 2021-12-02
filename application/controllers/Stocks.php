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

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$res = $this->model_stock->update($_POST , $id);

				if($res) 
				{
					flash_set("Stock updated");
					return redirect( base_url('stocks/index') );
				}else
				{
					flash_set("Stocks update failed" , 'danger');
				}
			}

			$stock = $this->model_stock->get($id);

			$this->data['stock'] = $stock;

			return $this->render_template('stocks/edit' , $this->data);
		}

		public function index()
		{
			$stocks = $this->model_stock->getAll();

			$this->data['stocks'] = $stocks;

			return $this->render_template('stocks/index' , $this->data);
		}
	}