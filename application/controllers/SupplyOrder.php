<?php 

	class SupplyOrder extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = ' Supply Order ';
			$this->load->model('model_supplier');
			$this->load->model('model_supply_order');
			$this->load->model('model_supply_order_item');

			$this->data['suppliers'] = $this->model_supplier->getAll();
		}

		public function index()
		{
			$this->data['supply_orders'] = $this->model_supply_order->getAll();

			return $this->render_template('supply_order/index' , $this->data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = $_POST;

				$res = $this->model_supply_order->create($post);

				if($res) {
					flash_set("Supply Order created");
					return redirect("SupplyOrder/show/".$res);
				}
			}

			return $this->render_template('supply_order/create' , $this->data);
		}

		public function show( $id )
		{
			$supply_order = $this->model_supply_order->get($id);
			$supply_order_items = $this->model_supply_order_item->getByOrder($id);
			
			$this->data['supply_order'] = $supply_order;
			$this->data['order_items'] = $supply_order_items;

			return $this->render_template('supply_order/show' , $this->data);
		}

		public function edit( $id )
		{
			if( isSubmitted() )
			{
				$post = $_POST;

				$res = $this->model_supply_order->update($post, $id);

				if($res) {
					flash_set('Supply Order updated');
					return redirect('SupplyOrder/show/'.$id);
				}

				flash_set('update failed!');
			}

			$supplier_order = $this->model_supply_order->get($id);

			$this->data['supply_order'] = $supplier_order;

			return $this->render_template('supply_order/edit' , $this->data);
		}
	}