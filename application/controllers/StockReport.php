<?php 

	class StockReport extends Admin_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = ' Stocks Report';
			$this->load->model('model_stock');
		}

		public function index()
		{
			$this->data['stocks'] = $this->model_stock->getReportGroupProduct();
			
			return $this->render_template('stock_report/index' , $this->data);
		}
	}