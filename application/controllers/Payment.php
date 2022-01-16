<?php 

	class Payment extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'pay your order';

			$this->load->model('model_orders');
			$this->load->model('model_payment');
			$this->load->model('model_stock');
			$this->load->model('model_notification');
			$this->load->model('model_users');

			$this->load->model('model_payment_gcash');
			$this->load->model('model_notification');

			$this->model_payment_gcash->injectModels([
				'model_notification' => $this->model_notification,
				'model_payment' => $this->model_payment
			]);

			$this->model_payment->injectModels([
				'model_orders' => $this->model_orders,
				'model_stock'  => $this->model_stock,
				'model_notification' => $this->model_notification,
				'model_user' => $this->model_users
			]);
		}

		public function index()
		{
			if( isEqual($this->data['user_data']['user_type'] , 'customer') ){
				$this->data['payments'] = $this->model_payment->getAll([
					'where' => [
						'payment.user_id' => $this->data['user_data']['id']
					],
					'order' => ' payment.id desc'
				]);
			}else{
				$this->data['payments'] = $this->model_payment->getAll([
					'order' => 'payment.id desc'
				]);
			}
			

			return $this->render_template('payment/index' , $this->data);
		}

		 /*
	    * This function is invoked from another function to upload the image into the assets folder
	    * and returns the image path
	    */
		public function upload_image()
	    {
	    	
	        $config = $this->set_upload_options();

	        // $config['max_width']  = '1024';s
	        // $config['max_height']  = '768';

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('payment_image'))
	        {
	            $error = $this->upload->display_errors();
	            return $error;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            $type = explode('.', $_FILES['payment_image']['name']);
	            $type = $type[count($type) - 1];
	            
	            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
	            return ($data == true) ? $path : false;            
	        }
	    }


	    private function set_upload_options()
	    {   
	        //upload an image options
	        $config = array();
	        // assets/images/product_image
	        $config['upload_path'] = 'assets/images/sample_image';
	        $config['file_name'] =  uniqid();
	        $config['allowed_types'] = 'gif|jpg|png';


	        return $config;
	    }

		public function create( $order_id = null )
		{
			if( isSubmitted() )
			{
				$res = $this->model_payment->createAndDeductStock($_POST);
				return dd($res);
			}

			$order = $this->model_orders->getOrderWithItems($order_id);

			if( !$order ){
				flash_set("Order not found!");
				return redirect('landing');
			}

			$this->data['order'] = $order;

			// dd($this->data['order']);

			return $this->view_public('payment/create' , $this->data);
		}

		public function submit_payment_gcash()
		{
			if( isSubmitted() )
			{
				$image = $this->upload_image();

				$res = $this->model_payment_gcash->createWithImage( $_POST , $image);

				if(!$res) {
					flash_set( $this->model_payment_gcash->getErrorString() , 'danger');
				}else{
					flash_set( "Gcash Payment Attached");
				}

				return redirect('orders/show/'.$_POST['order_id']);
			}
		}

		public function gcash_edit($id)
		{	
			if( isSubmitted() )
			{
				$post = $_POST;
				$image = '';

				if(!empty($_FILES['payment_image']['name']))
				{
					$image = $this->upload_image();
				}

				$res = $this->model_payment_gcash->updateWithImage( $post , $id , $image );

				if($res) {
					flash_set("Payment Updated");
				}else{
					flash_set( $this->model_payment_gcash->getErrorString() , 'danger');
				}

				return redirect('orders/show/'.$post['order_id']);
			}

			$gcash = $this->model_payment_gcash->get($id);
			$order = $this->model_orders->get($gcash['order_id']);

			$data = [
				'gcash' => $gcash,
				'order' => $order
			];

			$data = array_merge($data , $this->data);

			
			return $this->render_template('payment/gcash_edit' , $data);
		}

		public function gcash_delete( $id )
		{
			$gcash = $this->model_payment_gcash->get($id);

			$res = $this->model_payment_gcash->delete($id);

			flash_set("Payment deleted");

			return redirect('orders/show/'.$gcash['order_id']);
		}

		public function gcash_valid_invalid()
		{
			if( isSubmitted() )
			{
				$post = $_POST;

				$gcash = $this->model_payment_gcash->get($post['id']);

				if( isset($post['valid']))
				{
					$res = $this->model_payment_gcash->validOrInvalid($post['id'] , 'valid');
				}

				if( isset($post['invalid']))
				{
					$res = $this->model_payment_gcash->validOrInvalid($post['id'] , 'invalid');
				}
				
				if(!$res) {
					flash_set( $this->model_payment_gcash->getErrorString() , 'danger');
				}

				return redirect('orders/show/'.$gcash['order_id']);
			}
			
		}

		public function submit_payment()
		{
			if( isSubmitted() )
			{	

				$res = $this->model_payment->createPayment($_POST);
				print_r($_POST);
			}else{
				echo 'get-request';
			}
			
		}

		public function thank_you_page()
		{
			if( $this->data['user_data']['logged_in'] ){
				flash_set("Payment sent!");
				return redirect('orders/');
			}
			echo '<h1>Thank you for your purchase , order details has been sent to your email.</h1>'; 
		}
	}