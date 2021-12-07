<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Supplier';

		$this->load->model('model_supplier');
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function index()
	{
		$this->data['suppliers'] = $this->model_supplier->getAll();
		
		$this->render_template('supplier/index', $this->data);
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function create()
	{	

		if( isSubmitted() )
		{
			$post = $_POST;

			$res = $this->model_supplier->create($post);

			if( $res ){
				flash_set('Supplier Created' , 'success');
				return redirect('supplier/index');
			} 
			flash_set('Supplier create failed' , 'danger');
			
			return redirect('supplier/create');
		}
		
		$this->render_template('supplier/create', $this->data);	
	}


	public function edit($id = null)
	{
		if(isSubmitted())
		{
			$post = $_POST;

			$res = $this->model_supplier->update($post, $post['id']);
			
			return redirect('supplier/edit/'.$id, 'refresh');
		}

		$supplier = $this->model_supplier->get($id);

		$this->data['supplier'] = $supplier;
		
		$this->render_template('supplier/edit' , $this->data);
	}
}