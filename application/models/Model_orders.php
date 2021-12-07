<?php 

class Model_orders extends Model_adapter
{		

	public $_table_name = 'orders';

	public $_fillables = [
		'id' , 'bill_no',
		'customer_name','customer_address', 
		'customer_email','customer_phone',
		'customer_phone','date_time',
		'gross_amount','service_charge_rate',
		'service_charge','vat_charge_rate',
		'vat_charge','net_amount',
		'discount','paid_status',
		'user_id','	origin'
	];


	public function updateDeliveryStatus($status , $id)
	{
		return parent::update([
			'delivery_status' => $status
		] , $id);
	}



	public function getOrderWithItems( $id )
	{
		$order = $this->getOrdersData($id);

		if(!$order){
			flash_set("Order not found" , 'danger');
			return false;
		}

		$items = $this->getOrdersItemData($order['id']);

		$order['items'] = $items;

		return $order;
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{	
		if($id) 
			return parent::queryResultSingle(
				"SELECT * , 
				CASE 
				WHEN paid_status = 1 THEN 'PAID'
				WHEN paid_status = 0 THEN 'UNPAID' 
				end as payment_status
				FROM orders
				WHERE id = '{$id}'
				ORDER BY id DESC"
			);

		return parent::queryResultArray(
			"SELECT * , 
				CASE 
				WHEN paid_status = 1 THEN 'PAID'
				WHEN paid_status = 0 THEN 'UNPAID' 
				end as payment_status
				FROM orders ORDER BY id DESC"
		);
	}

	public function getOrdersItemData($order_id)
	{
		return parent::queryResultArray(
			"SELECT product.name ,
			order_item.id as id,
			order_item.order_id as order_id,
			order_item.product_id as product_id, 
			order_item.qty as qty,
			order_item.rate as rate,
			order_item.amount as amount

			FROM orders_item as order_item 
			LEFT JOIN products as product
			ON product.id = order_item.product_id

			WHERE order_item.order_id = '{$order_id}' 
			ORDER BY order_item.id desc"
		);
	}

	public function updateWithItems( $order_data , $order_items)
	{
		$_fillables = $this->getFillablesOnly($order_data);

		$res = parent::update($_fillables , $_fillables['id']);

		$delete_item_first = $this->dbdelete('orders_item' , $this->conditionConvert([
			'order_id' => $_fillables['id']
		]) );

		$item_inserted = 0;

		$order = $this->getOrdersData($_fillables['id']);

		if($delete_item_first) {

			foreach($order_items as $row) 
			{
				$row['order_id'] = $_fillables['id'];

				$res = $this->dbinsert('orders_item' , $row);

				//if inserted dededuct to stocks
				$this->model_stock->addStock([
					'quantity' => $row['qty'],
					'type'     => 'deduct',
					'product_id' => $row['product_id'],
					'description' => ' Order from '.$order['bill_no'],
					'date' => date('Y-m-d', $order['date_time'])
				]);

				$item_inserted++;
			}
		}

		if( $item_inserted && $res ){
			$this->addMessage("Order Updated!");
			return true;
		} 

		$this->addError("Order update failed");
		return false;
	}


	public function create($order_data)
	{
		if( !isset($order_data['product']) || empty($order_data['product']) )
		{
			$this->addError("No order items to migrate");
			return false;
		}


		$datetime = strtotime(date('Y-m-d h:i:s a'));
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

		$_fillables = $this->getFillablesOnly($order_data);
		$_fillables['date_time'] = $datetime;
		$_fillables['bill_no'] = $bill_no;

		$res = parent::create($_fillables);

		if($res) 
		{
			foreach($order_data['product'] as $index => $product) 
			{
				$qty = $order_data['qty'][$index];
				$rate = $order_data['rate_value'][$index];
				$amount = $order_data['amount_value'][$index];

				$order_item_data =  [
					'order_id' => $res,
					'product_id' => $product,
					'qty' => $qty,
					'rate'  => $rate,
					'amount' => $amount
				];

				$insert_item = $this->dbinsert('orders_item',$order_item_data);

				//deduct from stocks

				$deduct_stock = $this->model_stock->addStock([
					'quantity' => $qty,
					'type'     => 'deduct',
					'product_id' => $product,
					'description' => ' Order from '.$bill_no,
					'date' => date('Y-m-d H:i:s')
				]);
			}

			//CREATE PAMYNETS

			$this->model_payment->createBasic([
				'amount' => $_fillables['net_amount'],
				'method' => 'cash',
				'order_id' => $res
			]);
			return $res;
		}
		return false;
	}

	public function createFromCart($order_data)
	{
		
		if( isset( $this->cart_model ) )
		{	

			$cart_items = $this->cart_model->getActiveCart();

			if( !$cart_items ){
				flash_set("There are not cart-items , unable to complete checkout" , 'danger');
				return false;
			}

			$total_amount = 0;

			foreach($cart_items as $row) {
				$total_amount += $row['price'] * $row['quantity'];
			}

			$date = strtotime(date('Y-m-d h:i:s a'));

			$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

			$_fillables = $this->getFillablesOnly($order_data);

			$_fillables['date_time'] = $date;
			$_fillables['bill_no']  = $bill_no;
			$_fillables['gross_amount'] = $total_amount;
			$_fillables['net_amount'] = $total_amount;
			$_fillables['paid_status'] = 0;
			$_fillables['origin'] = 'online';

			$order_id = parent::create ( $_fillables );
			
			foreach($cart_items as $row) 
			{
				$order_item = [
					'order_id' => $order_id,
					'product_id' => $row['product_id'],
					'qty'      => $row['quantity'],
					'rate'     => $row['price'],
					'amount'   => $row['price'] * $row['quantity']
				];

				$res = parent::dbinsert('orders_item' , $order_item);
			}

			/*
			*check cart-item
			*token
			*/

			$this->cart_model->deleteCartItems();
			$this->cart_model->killToken();

			flash_set("Add payment to complete order");
			return $order_id;
		}else
		{
			flash_set("Cart Model not set unable to process checkout" , 'danger');
			return false;
		}
	}


	public function getAll($params = [])
	{
		$where = null;
		$order = null;

		if( isset($params['where']) )
			$where = " WHERE ".$this->conditionConvert($params['where']);
		if( isset($params['order']) )
			$order = " ORDER BY ".$params['order'];

		return parent::queryResultArray(
			"SELECT * FROM {$this->_table_name}
				{$where}{$order}"
		);
	}

	// public function create()
	// {
	// 	$user_id = $this->session->userdata('id');
	// 	$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

	// 	$net_amount_value = $this->input->post('net_amount_value');

 //    	$data = array(
 //    		'bill_no' => $bill_no,
 //    		'customer_name' => $this->input->post('customer_name'),
 //    		'customer_address' => $this->input->post('customer_address'),
 //    		'customer_phone' => $this->input->post('customer_phone'),
 //    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
 //    		'gross_amount' => $this->input->post('gross_amount_value'),
 //    		'service_charge_rate' => $this->input->post('service_charge_rate'),
 //    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
 //    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
 //    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
 //    		'net_amount' => $net_amount_value,
 //    		'discount' => $this->input->post('discount'),
 //    		'paid_status' => 1,
 //    		'user_id' => $user_id
 //    	);

	// 	$insert = $this->db->insert('orders', $data);
	// 	$order_id = $this->db->insert_id();

	// 	$this->load->model('model_products');

	// 	$count_product = count($this->input->post('product'));
 //    	for($x = 0; $x < $count_product; $x++) {
 //    		$items = array(
 //    			'order_id' => $order_id,
 //    			'product_id' => $this->input->post('product')[$x],
 //    			'qty' => $this->input->post('qty')[$x],
 //    			'rate' => $this->input->post('rate_value')[$x],
 //    			'amount' => $this->input->post('amount_value')[$x],
 //    		);

 //    		$this->db->insert('orders_item', $items);

 //    		// now decrease the stock from the product
 //    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
 //    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

 //    		$update_product = array('qty' => $qty);


 //    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
 //    	}

 //    	/*create-payment*/

 //    	if($order_id) 
 //    	{
 //    		$this->db->insert('payments' , [
 //    			'reference' => generateRandomString(10),
 //    			'amount'    => $net_amount_value,
 //    			'method'    => 'cash',
 //    			'order_id'  => $order_id
 //    		]);
 //    	}

	// 	return ($order_id) ? $order_id : false;
	// }

	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM orders_item WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}


	public function update($order_data , $id)
	{
		$_fillables = $this->getFillablesOnly($order_data);
	}

	// public function update($id)
	// {	



	// 	if($id) {
	// 		$user_id = $this->session->userdata('id');
	// 		// fetch the order data 

	// 		$data = array(
	// 			'customer_name' => $this->input->post('customer_name'),
	//     		'customer_address' => $this->input->post('customer_address'),
	//     		'customer_phone' => $this->input->post('customer_phone'),
	//     		'gross_amount' => $this->input->post('gross_amount_value'),
	//     		'service_charge_rate' => $this->input->post('service_charge_rate'),
	//     		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	//     		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	//     		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	//     		'net_amount' => $this->input->post('net_amount_value'),
	//     		'discount' => $this->input->post('discount'),
	//     		'paid_status' => $this->input->post('paid_status'),
	//     		'user_id' => $user_id
	//     	);

	// 		$this->db->where('id', $id);
	// 		$update = $this->db->update('orders', $data);

	// 		// now the order item 
	// 		// first we will replace the product qty to original and subtract the qty again
	// 		$this->load->model('model_products');
	// 		$get_order_item = $this->getOrdersItemData($id);
	// 		foreach ($get_order_item as $k => $v) {
	// 			$product_id = $v['product_id'];
	// 			$qty = $v['qty'];
	// 			// get the product 
	// 			$product_data = $this->model_products->getProductData($product_id);
	// 			$update_qty = $qty + $product_data['qty'];
	// 			$update_product_data = array('qty' => $update_qty);
				
	// 			// update the product qty
	// 			$this->model_products->update($update_product_data, $product_id);
	// 		}

	// 		// now remove the order item data 
	// 		$this->db->where('order_id', $id);
	// 		$this->db->delete('orders_item');

	// 		// now decrease the product qty
	// 		$count_product = count($this->input->post('product'));
	//     	for($x = 0; $x < $count_product; $x++) {
	//     		$items = array(
	//     			'order_id' => $id,
	//     			'product_id' => $this->input->post('product')[$x],
	//     			'qty' => $this->input->post('qty')[$x],
	//     			'rate' => $this->input->post('rate_value')[$x],
	//     			'amount' => $this->input->post('amount_value')[$x],
	//     		);
	//     		$this->db->insert('orders_item', $items);

	//     		// now decrease the stock from the product
	//     		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	//     		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	//     		$update_product = array('qty' => $qty);
	//     		$this->model_products->update($update_product, $this->input->post('product')[$x]);
	//     	}

	// 		return true;
	// 	}
	// }



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('orders_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		return parent::queryResultSingle(
			"SELECT count(id) as total_orders FROM orders WHERE paid_status = 1"
		)->total_orders ?? 0;

		// $sql = "SELECT * FROM orders WHERE paid_status = ?";
		// $query = $this->db->query($sql, array(1));
		// return $query->num_rows();
	}

}