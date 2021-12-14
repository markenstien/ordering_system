<?php 

	class Model_return_process extends Model_adapter
	{
		public $_table_name = 'return_processs';


		public function update($text , $id)
		{
			return parent::update([
				'text_content' => $text
			], $id);
		}
		

		public function get($id = null){
			return parent::get(1);
		}
	}