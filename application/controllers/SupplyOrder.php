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

			$this->load->model('model_stock');

			$this->data['suppliers'] = $this->model_supplier->getAll();

			$this->model_supply_order->injectModels([
				'model_supply_order_item' => $this->model_supply_order_item
			]);
		}

		public function index()
		{
			$this->data['supply_orders'] = $this->model_supply_order->getAll([
				'order' => 'supply_order.id desc'
			]);

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

		//this is an action
		public function delivered($supply_order_id)
		{	
			/*get supply order*/

			$this->model_supply_order->injectModels([
				'model_supply_order_item' => $this->model_supply_order_item,
				'model_stock' =>  $this->model_stock
			]);

			$res = $this->model_supply_order->migrateToStocks( $supply_order_id );

			if($res) {
				flash_set( $this->model_supply_order->getMessageString() );
			}else{
				flash_set($this->model_supply_order->getErrorString() , 'danger');
			}
			return redirect('supplyOrder/show/'.$supply_order_id);
		}

		public function cancel($supply_order_id)
		{
			$this->model_supply_order->update([
				'status' => 'cancelled'
			] , $supply_order_id);

			flash_set("Supply cancelled");

			return redirect('supplyOrder/show/'.$supply_order_id);
		}

		public function reOrder($supply_order_id)
		{
			$res = $this->model_supply_order->reOrder( $supply_order_id );

			if($res) {
				flash_set("Supply Order Re-Created");
				return redirect("SupplyOrder/show/".$res);
			}
		}
	}