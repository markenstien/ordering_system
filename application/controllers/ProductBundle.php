<?php 

	class ProductBundle extends Admin_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'Product Bundling';

			$this->load->model('model_product_bundle');
			$this->load->model('model_product_bundle_item');
			$this->load->model('model_products');
		}

		public function create()
		{
			if( isSubmitted() )
			{
				$res = $this->model_product_bundle->create($_POST);
				if($res){
					flash_set("Product Bundle {$_POST['name']} has been created.");
					return redirect('productBundleItem/add/'.$res);
				}
			}

			return $this->render_template('product_bundle/create' , $this->data);
		}

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$res = $this->model_product_bundle->update($_POST , $_POST['id']);

				if($res){
					flash_set("Bundle updated");
					return redirect('productBundle/show/'.$_POST['id']);
				}

				flash_set('something went wrong');
			}

			$this->data['bundle'] = $this->model_product_bundle->get($id);

			return $this->render_template('product_bundle/edit', $this->data);
		}

		public function index()
		{
			$res = $this->model_product_bundle->getAll();
			
			$this->data['product_bundles'] = $this->model_product_bundle->getRowArray();

			return $this->render_template('product_bundle/index' , $this->data);
		}

		public function show($id)
		{
			$bundle = $this->model_product_bundle->get($id);
			$bundle_items = $this->model_product_bundle_item->getByBundle($id);

			$this->data['bundle'] = $bundle;
			$this->data['bundle_items'] = $bundle_items;

			return $this->render_template('product_bundle/show' , $this->data);
		}

		public function removePublicPrice($id)
		{
			$this->model_product_bundle->injectModels([
				'model_product' => $this->model_products,
				'model_bundle_items' => $this->model_product_bundle_item
			]);

			$this->model_product_bundle->removePublicPrice($id);

			flash_set("Bundle Market Price set to total item price");
			
			return redirect('productBundle/show/'.$id);
		}
	}