<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierController extends Admin_Controller 
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

		$this->render_template('supplier/index', $this->data);	
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function create()
	{	

		if( isset($_POST['submit']) )
		{
			$post = $_POST;

			$this->model_supplier->create($post);

		}

		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('supplier/create', $this->data);	
	}

}