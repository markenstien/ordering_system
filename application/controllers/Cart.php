<?php 

	class Cart extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['title'] = 'Cart Items';
			$this->load->model('model_stock');

			//if user is logged-in
			if( $this->session->userdata('logged_in') ) 
				$this->model_cart_wish->setUser( $this->session->userdata() );

			$this->data['cart_items'] = $this->model_cart_wish->getActiveCart();
			$this->load->model('model_orders');
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

		public function updateMultiple()
		{
			if ( isSubmitted() )
			{

				$is_ok = $this->model_cart_wish->updateMultiple( $_POST );
				if( $is_ok ){
					flash_set("Cart Updated");
					return redirect('cart/index');
				}
			}
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


			if( isset($_GET['bundle_id']) )
			{
				$this->load->model('model_product_bundle');
				$this->load->model('Model_product_bundle_item');

				$this->model_product_bundle->injectModels([
					'model_bundle_item' => $this->Model_product_bundle_item
				]);

				$bundle = $this->model_product_bundle->getAllWithItems([
					'where' => ['id' => $_GET['bundle_id']]
				])[0];


				if($bundle){
					$is_ok = $this->model_orders->checkItemsStockAvailability( $bundle['items'] );

					if(!$is_ok){
						flash_set( $this->model_orders->getErrorString() , 'danger');
						return redirect('bundles/index');
					}
				}

				$this->data = array_merge( $this->data , [
					'bundle' => $bundle
				]);

				return $this->view_public('cart/checkout_bundle', $this->data);
			}


			return $this->view_public('cart/checkout', $this->data);
		}

		public function checkout_bundle()
		{
			$bundle_id = $_GET['bundle_id'];

			$this->load->model('model_product_bundle');
			$this->load->model('Model_product_bundle_item');

			$this->model_product_bundle->injectModels([
				'model_bundle_item' => $this->Model_product_bundle_item
			]);


			$bundle = $this->model_product_bundle->getAllWithItems([
				'where' => ['id' => $_GET['bundle_id']]
			])[0];


			$post = $_POST;
			$post['bundle_id'] = $bundle_id;

			$res = $this->model_orders->createFromBundle($post , $bundle);

			if($res)
			{
				$this->model_cart_wish->deleteCartItems();
				$this->model_cart_wish->killToken();
				
				return redirect('payment/create/'.$res);
			}else
			{
				flash_set( $this->model_orders->getErrorString() , 'danger');
				return redirect('cart/checkout?bundle_id='.$bundle_id);
			}
		}
	}