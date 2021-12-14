<?php 


	class Delivery extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_delivery');
			$this->load->model('model_orders');
			$this->load->model('model_notification');

			$this->model_delivery->injectModels([
				'model_orders' => $this->model_orders,
				'model_notification' => $this->model_notification
			]);
		}	

		public function index()
		{	
			$deliveries = $this->model_delivery->getAll();

			$this->data['deliveries'] = $deliveries;

			return $this->render_template('delivery/index' , $this->data);
		}

		public function create($order_id)
		{
			if( isSubmitted() )
			{
				$res = $this->model_delivery->create($_POST);

				if($res) {
					flash_set("Delivery created!");
					return redirect('orders/show/'.$_POST['order_id']);
				}
			}

			$this->data['page_title'] = 'Delivery';

			$this->data['order'] = $this->model_orders->getOrdersData($order_id);

			return $this->render_template('delivery/create' , $this->data);
		}

		public function show($id)
		{
			$this->model_delivery->injectModels([
				'model_order' => $this->model_orders
			]);

			$delivery = $this->model_delivery->getComplete($id);

			$this->data['order'] = $delivery['order'];
			$this->data['order_items'] = $delivery['order']['items'] ?? [];

			$this->data['delivery'] = $delivery;
			$this->data['page_title'] = 'Delivery';
			
			return $this->render_template('delivery/show' , $this->data);
		}

		public function updateStatus($delivery_id)
		{
			if( isSubmitted() )
			{
				$post = $_POST;

				if(isEqual($post['status'], 'cancelled') && empty($post['remarks']) ) {
					flash_set("Order is cancelled , please enter the reason in remarks.");
					
				}else
				{
					//incject model order
					$this->model_delivery->injectModels([
						'model_order' => $this->model_orders
					]);

					$res = $this->model_delivery->updateStatus($post , $delivery_id);
					if($res){
						flash_set("Delivery status updated! {$post['status']}");
					}else{
						flash_set("Delivery update failed!");
					}
				}

				return redirect('orders/show/'.$this->model_delivery->order_id);
			}
		}
	}