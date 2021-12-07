<?php 

	class Toc extends Admin_Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'TOC';
			$this->load->model('model_attachment');
			$this->load->helper("file");
		}

		/*
		*customers must accept toc first before they can login-to-the system
		*/
		public function loadToc()
		{
			$this->data['toc_file'] = $this->model_attachment->getToc();

			if( isSubmitted() )
			{
				$this->load->model('model_users');

				$res = $this->model_users->update([
					'toc_agreed' => true
				] , $this->data['user_data']['id']);

				if($res) {
					flash_set('terms and condition accepted!');
					return redirect('dashboard' , 'refresh');
				}
			}

			return $this->render_clean_template('toc_accept' , $this->data);
		}

		/*
		*Preview Toc
		*/
		public function index()
		{
			if(isSubmitted())
			{
				$upload_params = $this->upload_image();

				if(!$upload_params) {
					flash_set('erorr uploading toc file');
					return redirect('toc/index');
				}

				$this->model_attachment->save($upload_params);
			}

			$this->data['toc_file'] = $this->model_attachment->getToc();
			//get toc
			return $this->render_template('toc/index' , $this->data);
		}

		public function loadFrame()
		{
			/*
			*skeleton
			*/


			return $this->render_clean_template('');
		}

		public function upload_image()
	    {
	    	// assets/images/product_image
	        $config['upload_path'] = 'assets/documents';
	        $config['file_name'] =  uniqid();
	        $config['allowed_types'] = 'pdf';
	        $config['max_size'] = '1000';

	        // $config['max_width']  = '1024';s
	        // $config['max_height']  = '768';

	        //load library
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('file'))
	        {
	            $error = $this->upload->display_errors();
	            return $error;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            $type = explode('.', $_FILES['file']['name']);
	            $type = $type[count($type) - 1];
	            
	            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;

	            //upload is ok

	            if($data == true)
	            {
	            	return [
	            		'full_path' => $path,
	            		'filename' => $config['file_name'].'.'.$type,
	            		'path'      => $config['upload_path'],
	            		'file_type' => $type,
	            		'search_key' => 'Toc PDF FILE'
	            	];
	            }

	            return false;        
	        }
	    }
	}