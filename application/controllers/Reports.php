<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = 'Stores';
		$this->load->model('model_reports');

		$this->load->model('model_orders');
		$this->load->model('model_payment');
		$this->load->model('model_stock');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$parking_data = $this->model_reports->getOrderData($today_year);
		$this->data['report_years'] = $this->model_reports->getOrderYear();
		

		$final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['gross_amount'];						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}
		
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['results'] = $final_parking_data;

		$this->render_template('reports/index', $this->data);
	}

	//get
	public function advance()
	{
		if( isSubmitted() )
		{
			$post = $_POST;

			$this->model_reports->injectModels([
				'model_order' => $this->model_orders,
				'model_stock' => $this->model_stock,
			]);

			$this->data['report'] = $this->model_reports->report($post , $post['type']);
			$this->data['date'] = [
				'start_date' => $post['start_date'],
				'end_date'   => $post['end_date']
			];
			$this->data['order_group'] = $post['order_group'];
			if( isEqual($post['type'] , 'sales') )
			{

				// dd(strtotime($post['start_date']));

				if( !isEqual($post['order_group'] , 'NO GROUP') )
					$this->data['orders_grouped'] = $this->model_reports->customize_by_report_type( 
						$this->model_reports->orders ?? [] , $post['order_group']);

				return $this->render_clean_template('sales_report' , $this->data);
			}

			if( isEqual($post['type'] , 'inventory') )
			{
				// dd($this->data['report']);
				$this->data['stocks'] = $this->model_reports->stocks ?? [];

				if( $this->data['stocks'] )
				$this->data['order_group'] = $this->model_reports->customize_by_type( $this->data['stocks'] , $post['order_group']);


				// dd($this->data['order_group']);

				return $this->render_clean_template('inventory_report' , $this->data);
			}
			

			
		}

		return $this->render_template('reports/advance_filter' , $this->data);
	}
}	