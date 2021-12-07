<?php 

	class Model_attachment extends Model_adapter
	{

		public $_table_name = 'attachments';


		public $_fillables = [
			'id' , 'label',
			'filename' , 'file_type',
			'display_name' , 'search_key',
			'description' , 'global_key',
			'global_id' , 'path',
			'url' , 'full_path',
			'full_url' , 'is_visible',
			'created_by' , 'created_at'
		];

		public function getToc()
		{
			return $this->getRow([
				'global_key' => 'TOC_PDF_FILE'
			]);
		}

		public function save($file_data , $id = null)
		{
			$_fillables = $this->getFillablesOnly($file_data);
			//check exists then delete then overwrite
			$_fillables['global_key'] = 'TOC_PDF_FILE';
			$item = $this->getToc();

			if($item) {
				parent::deleteKeyPair(['global_key' => 'TOC_PDF_FILE']);
				// unlink( $item['full_path'] );
			}
			//upload new toc
			return parent::create($_fillables);
		}

		public function agree($user_id)
		{
			/*
			*load-user-mode then update toc-status
			*/
		}
	}