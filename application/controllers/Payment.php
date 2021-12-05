<?php 

	class Payment extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'pay your order';

			$this->load->model('model_orders');
			$this->load->model('model_payment');
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