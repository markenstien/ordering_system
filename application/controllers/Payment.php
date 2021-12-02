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

		public function create( $order_id = null )
		{
			if( isSubmitted() )
			{
				$res = $this->model_payment->create($_POST);
				return dd($res);
			}

			$order = $this->model_orders->getOrderWithItems($order_id);

			if( !$order ){
				flash_set("Order not found!");
				return redirect('landing');
			}

			$this->data['order'] = $order;
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

		}
	}