<?php 

	class Cart extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['title'] = 'Cart Items';

			$this->load->model('model_cart_wish');
			$this->load->model('model_stock');

			//if user is logged-in
			if( $this->session->userdata('logged_in') ) 
				$this->model_cart_wish->setUser( $this->session->userdata() );

			$this->data['cart_items'] = $this->model_cart_wish->getActiveCart();
		}


		public function addItem()
		{
			if( isSubmitted() )
			{
				$user = $this->session->userdata();

				$this->model_cart_wish->injectModels(['stock' => $this->model_stock]);

				$res = $this->model_cart_wish->addItem( $_POST );

				flash_set( "Product Added to cart! ");

				if(!$res){
					flash_set( $this->model_cart_wish->getErrorString() , 'danger');
					return redirect('productPublic/show/'.$_POST['product_id']);
				}
				
				return redirect('cart/index/');
			}
			
		}

		public function updateItem($id)
		{
			$res = $this->model_cart_wish->updateItem($_POST , $id);

			flash_set('Cart Item updated!');
			if(!$res)
				flash_set("Cart item failed to update");

			return redirect('cart/index');
		}

		public function delete($id)
		{
			flash_set("Product deleted");
			$this->model_cart_wish->delete($id);

			return redirect('cart/index');
		}


		public function index()
		{
			return $this->view_public('cart/index' , $this->data);
		}

		public function checkout()
		{
			if( isSubmitted() )
			{
				$this->load->model('model_orders');

				$this->model_orders->injectModels([
					'cart_model' => $this->model_cart_wish,
					'model_stock' => $this->model_stock
				]);

				$res = $this->model_orders->createFromCart( $_POST );

				if($res){
					return redirect('payment/create/'.$res);
				}else{
					return redirect('cart/checkout');
				}
			}

			if( $this->session->userdata('logged_in') ){
				$this->data['user'] = $this->session->userdata();
			}else{
				$anchor = anchor('auth/login' , 'Click here to login');
				$register_anchor = anchor('auth/login' , 'Click here to Register');
				flash_set("You must have an account to login ." . $anchor . ' ' . $register_anchor . ' ' .'and continue shopping');

				return redirect('cart/index');
			}


			return $this->view_public('cart/checkout', $this->data);
		}
	}