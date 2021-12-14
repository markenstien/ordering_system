<?php 

	class ReturnOrder extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->load->model('model_orders');
			$this->load->model('model_return_order');
			$this->load->model('model_notification');
			$this->load->model('model_users');
			$this->load->model('model_return_process');

			$this->model_return_order->injectModels([
				'model_notification' => $this->model_notification,
				'model_users' => $this->model_users,
				'model_return_process' => $this->model_return_process
			]);
		}

		public function index()
		{
			$order_returns = $this->model_return_order->getAll([
				'order' => 'ret.id desc'
			]);

			$this->data['order_returns'] = $order_returns;
			$this->data['page_title'] = 'Return Order Items';

			return $this->render_template('return_order/index' , $this->data);
		}

		public function create($order_id)
		{	

			if( isSubmitted() )
			{
				$post  = $_POST;

				$ret_val = $this->testOrderItems($post['return_item']);

				if( is_bool($ret_val) )
				{
					//ok 
					$post['return_items'] = $post['return_item'];

					$result = $this->model_return_order->create($post);

					if( $result ){
						flash_set( $this->model_return_order->getMessageString() );
						return redirect('returnOrder/show/'.$result);
					}else{
						flash_set('order return failed!');
						return redirect('returnOrder/create/'.$order_id);
					}
				}else
				{
					flash_set( implode(',',$ret_val) , 'danger');
					return redirect('returnOrder/create/'.$order_id);
				}
			}

			$this->data['page_title'] = 'Return Order';

			$order_data = $this->model_orders->getOrderWithItems( $order_id );

			$this->data['order'] = $order_data;
			$this->data['order_items'] = $order_data['items'];

			return $this->render_template('return_order/create' , $this->data);
		}

		private function testOrderItems( $return_items )
		{
			$errors = [];

			$item_returned = 0;
			foreach($return_items as $key => $item) 
			{
				$order_qty = $item['order_qty'];
				$return_qty = $item['return_qty'];

				if( $return_qty < 0 ){
					array_push( $errors , " Invalid return quantity for product {$item['name']} ");
					continue;
				}

				if( intval($order_qty) < intval($return_qty) )
				{
					array_push( $errors , " Invalid return items for product {$item['name']} total ordered items : ($order_qty) returning items ($return_qty)");
				}

				$item_returned += $return_qty;
			}

			if( $item_returned ==  0) {
				array_push($errors,"You are not returning any-item");
			}

			if( empty($errors) )
				return true;

			return $errors;
		}

		public function show($id)
		{
			$return_order = $this->model_return_order->getComplete($id);

			$this->data['page_title'] = ' Return Order Preview';
			$this->data['return_order'] = $return_order;
			$this->data['return_order_items'] = $return_order['items'];

			$this->data['return_order_process'] = $this->model_return_process->get(1);
			
			return $this->render_template('return_order/show' , $this->data);
		}

		public function updateForChecking($id)
		{
			$this->model_return_order->updateStatus('for-checking' , $id );

			flash_set('Return Order updated for checking');

			return redirect('returnOrder/show/'.$id);
		}

		public function approve()
		{
			$post = $_POST;

			$res = $this->model_return_order->approve([
				'id' => $post['id'],
				'status' => $post['status'],
				'rermarks' => $post['rermarks']
			]);

			if($res) {
				flash_set( $this->model_return_order->getMessageString() );
			}else{
				flash_set( $this->model_return_order->getErrorString() , 'danger');
			}

			return redirect('returnOrder/show/'.$post['id']);
		}

		public function invalid()
		{
			$post = $_POST;

			$res = $this->model_return_order->invalid([
				'id' => $post['id'],
				'status' => $post['status'],
				'rermarks' => $post['rermarks']
			]);

			if($res) {
				flash_set( $this->model_return_order->getMessageString() );
			}else{
				flash_set( $this->model_return_order->getErrorString() , 'danger');
			}

			return redirect('returnOrder/show/'.$post['id']);
		}
	} 