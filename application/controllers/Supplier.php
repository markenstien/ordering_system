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
		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

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
				flast_set('Supplier Created' , 'success');
				return redirect('supplier/index');
			} 
			flast_set('Supplier create failed' , 'danger');
			
			return redirect('supplier/create');
		}

		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
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