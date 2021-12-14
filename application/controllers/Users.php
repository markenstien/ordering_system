<?php 

class Users extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->data['page_title'] = 'Users';
		

		$this->load->model('model_users');
		$this->load->model('model_groups');
		$this->load->model('registration_verification_model');
		$this->load->model('model_notification');


		$this->model_notification->operations_ids();

		$this->model_users->injectModels([
			'registration_verification_model' => $this->registration_verification_model,
			'model_notification'  => $this->model_notification
		]);
	}

	
	public function index()
	{
		$users = $this->model_users->getAll();

		$this->data['users'] = $users;

		$this->render_template('users/index', $this->data);
	}

	public function create()
	{
		if( isSubmitted() )
		{
			$res = $this->model_users->create($_POST);

			if(!$res) {
				flash_set( $this->model_users->getErrorString() , 'danger');
				return redirect('users/create');
			}else{
				flash_set("user created!");
				return redirect('users/index');
			}
		}

		$this->render_template('users/create', $this->data);
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id = null)
	{
		if( isSubmitted() )
		{
			$res = $this->model_users->update($_POST , $id);

			$login = $this->model_users->login;

			if($res)
			{
				$user_data = array(
	   				'id' => $login['id'],
			        'username'  => $login['username'],
			        'email'     => $login['email'],
			        'phone'     => $login['phone'],
			        'firstname' => $login['firstname'],
			        'lastname' => $login['lastname'],
			        'address'  => $login['address'],
			        'user_type'  => $login['user_type'],
			        'is_verified'  => $login['is_verified'],
			        'logged_in' => TRUE
				);

				$this->data['user_data'] = $user_data;

				$this->session->set_userdata($user_data);

				flash_set("User updated!");
			}else{
				flash_set("User update failed" , 'danger');
			}
		}

		$this->render_template('users/edit', $this->data);	
	}

	public function register()
	{	
		if( isSubmitted() )
		{
			$res = $this->model_users->create($_POST);
			if($res) {
				flash_set("You are now registered , please verify your account by clicking the verification
					link which is sent to your email '{$_POST['email']}' ");
				return redirect('auth/login');
			}else{
				flash_set( $this->model_users->getErrorString() , 'danger');
				return redirect('users/register');
			}
		}

		$this->data['title'] = 'User Registration';

		return $this->view_public('users/register' , $this->data);
	}

	public function delete($id)
	{
		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/delete/'.$id, 'refresh');
		        	}

			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('users/delete', $this->data);
			}	
		}
	}

	public function profile()
	{

		$user_id = $this->session->userdata('id');

		$user_data = $this->model_users->get($user_id);
		$this->data['user_data'] = $user_data;

        $this->render_template('users/profile', $this->data);
	}

	public function setting()
	{	
		$id = $this->session->userdata('id');

		if($id) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'username' => $this->input->post('username'),
		        		'email' => $this->input->post('email'),
		        		'firstname' => $this->input->post('fname'),
		        		'lastname' => $this->input->post('lname'),
		        		'phone' => $this->input->post('phone'),
		        		'gender' => $this->input->post('gender'),
		        	);

		        	$update = $this->model_users->edit($data, $id);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('users/setting/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('users/setting/', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'firstname' => $this->input->post('fname'),
			        		'lastname' => $this->input->post('lname'),
			        		'phone' => $this->input->post('phone'),
			        		'gender' => $this->input->post('gender'),
			        	);

			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('users/setting/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('users/setting/', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
			        	$groups = $this->model_users->getUserGroup($id);

			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('users/setting', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);
	        	$groups = $this->model_users->getUserGroup($id);

	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->model_groups->getGroupData();
	        	$this->data['group_data'] = $group_data;

				$this->render_template('users/setting', $this->data);	
	        }	
		}
	}


}