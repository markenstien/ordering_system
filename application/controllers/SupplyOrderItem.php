<?php 

	class SupplyOrderItem extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();
			
			$this->load->model('model_supply_order_item');
			$this->load->model('model_products');

			$this->data['page_title'] = 'Add Supply Order';

			$this->data['products'] = $this->model_products->getActiveProductData();
		}

		public function add($supply_order_id)
		{
			if( isSubmitted() )
			{
				$res = $this->model_supply_order_item->addItem( $supply_order_id , $_POST);

				if($res) {
					flash_set("Item added");
				}

				return redirect( base_url('SupplyOrder/show/'.$supply_order_id) );
			}

			$this->data['supply_order_id'] = $supply_order_id;
			return $this->render_template('supply_order_item/add' , $this->data);
		}

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$res = $this->model_supply_order_item->updateCustom([
					'quantity' => $_POST['quantity']
				],  $id);

				if($res) {
					flash_set("Item updated!");
					return redirect("SupplyOrder/show/".$this->model_supply_order_item->supply_order_id);
				}
			}

			$this->data['order_item'] = $this->model_supply_order_item->get($id);

			return $this->render_template('supply_order_item/edit' , $this->data);
		}

		public function delete($id)
		{
			$res = $this->model_supply_order_item->deleteCustom($id);

			if($res){
				flash_set("Item deleted");
				return redirect("supplyOrder/show/".$this->model_supply_order_item->supply_order_id);
			}
		}
	}