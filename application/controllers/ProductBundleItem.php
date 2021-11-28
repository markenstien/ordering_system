<?php 

	class ProductBundleItem extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = ' Product Bundle Item';
			
			$this->load->model('model_product_bundle');
			$this->load->model('model_product_bundle_item');
			$this->load->model('model_products');

			$this->data['products'] = $this->model_products->getAll();
		}

		public function add($bundle_id)
		{

			if( isSubmitted($bundle_id) )
			{
				$res = $this->model_product_bundle_item->add($_POST);

				if(!$res) {
					flash_set($this->model_product_bundle_item->getErrorString() , 'danger');
				}else{
					flash_set("Bundle Item added");
					return redirect("ProductBundle/show/".$_POST['bundle_id']);
				}
			}

			$this->data['bundle'] = $this->model_product_bundle->get($bundle_id);
			$this->data['bundle_id'] = $bundle_id;
			return $this->render_template('product_bundle_item/add' , $this->data);
		}

		public function edit($id)
		{

			if( isSubmitted() )
			{
				$res = $this->model_product_bundle_item->update($_POST , $_POST['id']);

				if($res) {
					flash_set("Product Bundle Updated");
					return redirect('productBundle/show/'.$_POST['bundle_id']);
				}
			}

			$item = $this->model_product_bundle_item->get($id);

			$this->data['bundle'] = $this->model_product_bundle->get($item['bundle_id']);
			$this->data['item'] = $item;

			return $this->render_template('product_bundle_item/edit' , $this->data);
		}

		public function delete( $id )
		{
			flash_set("Item deleted");

			$this->model_product_bundle_item->deleteCustom($id);

			return redirect('productBundle/show/'.$this->model_product_bundle_item->bundle_id);
		}
	}