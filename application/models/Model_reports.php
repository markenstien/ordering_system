<?php 

class Model_reports extends Model_adapter
{
	public function __construct()
	{
		parent::__construct();
	}

	/*getting the total months*/
	private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}

	/* getting the year of the orders */
	public function getOrderYear()
	{	
		$result = parent::queryResultArray("SELECT * FROM orders WHERE paid_status = '1'");

		$return_data = array();
		foreach ($result as $k => $v) {
			$date = date('Y', $v['date_time']);
			$return_data[] = $date;
		}

		$return_data = array_unique($return_data);

		return $return_data;
	}

	// getting the order reports based on the year and moths
	public function getOrderData($year)
	{	
		if($year) 
		{
			$months = $this->months();
			$result = parent::queryResultArray("SELECT * FROM orders WHERE paid_status = 1");

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', $v['date_time']);

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	


			return $final_data;
			
		}
	}

	/*
	*inject models
	*orders order-items
	*payments
	*
	*/
	public function report($dateRange , $type)
	{	

		if( isEqual($type , 'sales') )
			return $this->salesReport($dateRange['start_date'] , $dateRange['end_date']);

		if( isEqual($type , 'inventory') ){
			return $this->inventoryReport($dateRange['start_date'] , $dateRange['end_date']);
		}
	}

	

	public function salesReport($start_date , $end_date)
	{
		/*get orders within dates*/

		$orders = $this->model_order->getAll([
			'where' => " date_time > ". strtotime($start_date) . " and paid_status = 1",
			'order' => 'date_time desc'
		]);


		$this->orders = $orders;

		return $this->summarizeOrders($orders);
	}

	public function summarizeOrders($orders)
	{
		if($orders) 
		{
			$ret_val = [
				'total_sales_amount' => 0,
				'total_sales_count' => 0,
				'total_sales_item_count' => 0,
				'top_product' => null,
				'top_addresses' => [],
				'items' => [],
				'item_summarized' => [],
				'orders' => [],
			];

			$orders_with_items = [];

			$addresses = [];

			//get items
			foreach($orders as $key => $order) 
			{
				$items = $this->model_order->getOrdersItemData($order['id']);

				array_push($addresses , $order['customer_address']);

				if($items) 
				{
					$ret_val['total_sales_count']++;
					//push items
					array_push($ret_val['items'], $items);
				}
					

				$ret_val['total_sales_amount'] += floatval($order['net_amount']);

				$order['items'] = $items;

				array_push($orders_with_items , $order);
			}
			//set orders
			$ret_val['orders'] = $orders_with_items;
			//summarize items

			$item_summarized = [];

			if( $ret_val['items'] )
			{
				foreach($ret_val['items'] as $items)
				{	
					foreach($items as $item)
					{
						$prod_id = $item['product_id'];

						if( !isset($item_summarized[$prod_id]) ){
							$item_summarized[$prod_id] = [
								'name' => $item['name'],
								'total_sales_count'  => 0,
								'total_sales_amount' => 0 
							];
						}

						$ret_val['total_sales_item_count'] += intval($item['qty']);

						$item_summarized[$prod_id]['total_sales_count'] += intval($item['qty']);
						$item_summarized[$prod_id]['total_sales_amount'] += floatval($item['amount']);
					}
				}

				sort_items($item_summarized , 'total_sales_amount' , 'DESC');
				
				$ret_val['item_summarized'] = $item_summarized;

				$ret_val['top_product'] = current($item_summarized);
			}

			

			
			
			$addresses_summaries = array_count_values($addresses);
			arsort($addresses_summaries);
			$ret_val['top_addresses'] = $addresses_summaries;

			//summarize address
			return $ret_val;
		}else{
			return false;
		}
	}

	public function inventoryReport($start_date , $end_date)
	{

		$stocks = $this->model_stock->getAll([
			'where' => [
				'date' => [
					'condition' => 'between',
					'value' => [$start_date , $end_date]
				]
			],

			'order' => ' date desc'
		]);

		if(!$stocks)
			return false;


		$this->stocks = $stocks;

		
		$ret_val = $this->summarizeInventories($stocks);

		return $ret_val;
	}

	/*
	*grouped by product
	*/
	public function summarizeInventories($stocks)
	{
		$ret_val = [
			'inventory_stocks_count' => 0,
			'product_stock_variety_count' => 0,
			'product_stock_summary' => 0,

			'grouped_by_product' => []
		];

		$inventory_stocks_count = 0;

		$grouped_by_product = [];

		foreach($stocks as $row) 
		{
			$prod_id = $row['product_id'];

			if( !isset($grouped_by_product[$prod_id]) )
			{
				$grouped_by_product[$prod_id] = [
					'items' => [],
					'name'  => $row['product_name'],
					'min_stock'  => $row['min_stock'],
					'max_stock'  => $row['max_stock'],
					'transaction_count' => 0,
					'total_stocks' => 0 
				];
			}
			//push to items
			$grouped_by_product[$prod_id]['items'][] = $row;
			//increment transactions
			$grouped_by_product[$prod_id]['transaction_count']++;
			$grouped_by_product[$prod_id]['total_stocks'] += $row['quantity'];
			// if( !in_array($row['product_id'], $product_varieties))
			// 	array_push($product_varieties , $row['product_id']);

			$inventory_stocks_count += $row['quantity'];
		}
		
		$ret_val['grouped_by_product'] = $grouped_by_product;
		$ret_val['inventory_stocks_count'] = $inventory_stocks_count;
		$ret_val['product_stock_variety_count'] = count($grouped_by_product);

		//get product-summary
		$product_stock_summary = [];

		foreach($grouped_by_product as $row) 
		{
			$product_stock_summary[$row['name']] = [
				'total_stock_count' => $row['total_stocks'],
				'min_stock' => $row['min_stock'],
				'max_stock' => $row['max_stock']
			];
		}

		$ret_val['product_stock_summary'] = $product_stock_summary;

		return $ret_val;
	}

	/*
	*inventory items
	*/
	public function customize_by_type( $items , $type )
	{
		$process_items = null;
		if(!$items)
			return false;

		switch(strtolower($type))
		{
			case 'daily':
				$prev_date = null;
				foreach($items as $item) 
				{
					$date = $item['date'];
					if( is_null($process_items) ){
						$process_items[$date] = [];
						$prev_date = $date;
					}
					if( $prev_date != $date )
						$prev_date = $date;
					$process_items[$prev_date][] = $item;
				}			
			break;

			case 'monthly':
				$prev_date = null;
				foreach($items as $item) 
				{
					$date = $item['date'];

					$month = date('F' , strtotime($date));

					if( is_null($process_items) ){
						$process_items[$month] = [];
						$prev_date = $date;
					}

					if( date('m' , strtotime($prev_date)) != date('m' , strtotime($date)) )
						$prev_date = $date;
					$process_items[$month][] = $item;
				}			
			break;

			case 'yearly':
				$prev_date = null;
				foreach($items as $item) 
				{
					$date = $item['date'];

					$year = date('Y' , strtotime($date));
					if( is_null($process_items) ){
						$process_items[$year] = [];
						$prev_date = $date;
					}
					if( date('y' , strtotime($prev_date)) != date('y' , strtotime($date)) )
						$prev_date = $date;
					$process_items[$year][] = $item;
				}			
			break;
		}

		if(is_array($process_items))
		{
			$items = [];

			foreach($process_items as $key => $itemSets) {
				$items[$key] = $this->summarizeInventories($itemSets);
			}

			return $items;
		}

		return false;
	}

	/*
	*orders
	*type can be daily , weekly , monthly
	*/
	public function customize_by_report_type($orders , $type)
	{
		$ret_val = [];

		if( is_null($orders) || empty($orders) )
			return false;

		switch(strtolower($type))
		{
			case 'daily':
				$prev_date = null;

				foreach($orders as $order) 
				{
					if( is_null($prev_date) )
						$prev_date = date('Y-m-d' , $order['date_time']);

					$date = date('Y-m-d' , $order['date_time']);

					//change date
					if(! isEqual($date , $prev_date) )
						$prev_date = $date;



					if( ! isset($ret_val[$prev_date]) )
						$ret_val[$prev_date] = [];

					array_push($ret_val[$prev_date] , $this->summarizeOrders([$order]));
				}
			break;

			case 'monthly':
				$prev_date = null;

				foreach($orders as $order) 
				{
					if( is_null($prev_date) )
						$prev_date = date('m' , $order['date_time']);

					$date = date('m' , $order['date_time']);

					//change date
					if(! isEqual($date , $prev_date) )
						$prev_date = $date;



					if( ! isset($ret_val[$prev_date]) )
						$ret_val[$prev_date] = [];

					array_push($ret_val[$prev_date] , $this->summarizeOrders([$order]));
				}
			break;

			case 'yearly':
				$prev_date = null;

				foreach($orders as $order) 
				{
					if( is_null($prev_date) )
						$prev_date = date('y' , $order['date_time']);

					$date = date('y' , $order['date_time']);

					//change date
					if(! isEqual($date , $prev_date) )
						$prev_date = $date;



					if( ! isset($ret_val[$prev_date]) )
						$ret_val[$prev_date] = [];

					array_push($ret_val[$prev_date] , $this->summarizeOrders([$order]));
				}
			break;
		}

		return $ret_val;
	}

}