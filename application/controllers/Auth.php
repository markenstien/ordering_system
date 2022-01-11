<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
		$this->load->model('model_cart_wish');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {

           			$logged_in_sess = array(
           				'id'           => $login['id'],
				        'username'     => $login['username'],
				        'email'        => $login['email'],
				        'phone'        => $login['phone'],
				        'firstname'    => $login['firstname'],
				        'lastname'     => $login['lastname'],
				        'address'      => $login['address'],
				        'user_type'    => $login['user_type'],
				        'is_verified'  => $login['is_verified'],
				        'toc_agreed'   => $login['toc_agreed'],
				        'logged_in'    => TRUE
					);

					$this->session->set_userdata($logged_in_sess);

					if(!$login['toc_agreed'])
						return redirect('toc/loadToc');
					

					if( isset($_SESSION['cart_token']) && ! $login['user_type'] == 'admin')
					{
						//update this session
						$this->model_cart_wish->dbupdate($this->model_cart_wish->_table_name,[
							'user_id' => $login['id']
						] , $this->model_cart_wish->conditionConvert([
							'session' => $_SESSION['cart_token']
						]) );

						return redirect('cart/index' , 'refresh');
					}

           			redirect('dashboard', 'refresh');
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = 'Email does not exists';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('landing', 'refresh');
	}

}
