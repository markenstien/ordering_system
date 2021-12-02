<?php 

	class ProductPublic extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_products');
			$this->load->model('model_cart_wish');

			$this->data['page_title'] = 'Product Overview';
		}

		public function show($id)
		{	
			$this->data['cart_items'] = $this->model_cart_wish->getActiveCart();

			if( isset($_GET['is_cart_item']) )
			{
				$this->data['page_title'] = 'Edit Cart Item';
				$this->data['item']  = $this->model_cart_wish->getItem($id);

				if( !$this->data['item'] )
					echo die("CART ITEM DOES NOT EXISTS");

				$this->data['product'] = $this->model_products->getProductData($this->data['item']['product_id']);
			}else
			{
				$this->data['product'] = $this->model_products->getProductData($id);
			}

			return $this->view_public('product_public/show' , $this->data);
		}
	}