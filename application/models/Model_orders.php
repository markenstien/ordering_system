<?php 

class Model_orders extends CI_Model
{	

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

	public function __construct()
	{
		parent::__construct();

	}

	public function getFillablesOnly($datas)
	{
		$return = [];

		foreach($datas as $key => $row) {
			if( isEqual($key, $this->_fillables) )
				$return[$key] = $row;
		}
		return $return;
	}	


	public function injectModels($models = [] ){

		foreach($models as $model_name => $model) {
			$this->$model_name = $model;
		}
	}



	public function getOrderWithItems( $id )
	{
		$order = $this->getOrdersData($id);

		if(!$order){
			flash_set("Order not found" , 'danger');
			return false;
		}

		//items

		$query = $this->db->query(
			"SELECT p.* , ori.* , 
				ori.id as id , ori.qty as order_qty,
				ori.amount as order_item_total_amount
				FROM orders_item as ori 

				LEFT JOIN products as p 
				on ori.product_id = p.id

				WHERE ori.order_id = '{$id}' "
		);

		$items = $query->result_array();

		$order['items'] = $items;

		return $order;
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{	

		$sql = "
			SELECT * , 
			CASE 
				WHEN paid_status = 1 THEN 'PAID'
				WHEN paid_status = 0 THEN 'UNPAID' 
				end as payment_status
				FROM orders
		";

		if($id) {
			$sql .= " WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = $sql." ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM orders_item WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
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

			$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

			$_fillables = $this->getFillablesOnly($order_data);

			$_fillables['date_time'] = strtotime(date('Y-m-d h:i:s a'));
			$_fillables['bill_no']  = $bill_no;
			$_fillables['gross_amount'] = $total_amount;
			$_fillables['net_amount'] = $total_amount;
			$_fillables['paid_status'] = 0;
			
			$insert = $this->db->insert('orders', $_fillables);
			$order_id = $this->db->insert_id();

			foreach($cart_items as $row) 
			{
				$order_item = [
					'order_id' => $order_id,
					'product_id' => $row['product_id'],
					'qty'      => $row['quantity'],
					'rate'     => $row['price'],
					'amount'   => $row['price'] * $row['quantity']
				];

				$this->db->insert('orders_item' , $order_item);
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

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    		'net_amount' => $this->input->post('net_amount_value'),
    		'discount' => $this->input->post('discount'),
    		'paid_status' => 1,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('orders', $data);
		$order_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'order_id' => $order_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
    		);

    		$this->db->insert('orders_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($order_id) ? $order_id : false;
	}

	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM orders_item WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
				'customer_name' => $this->input->post('customer_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'customer_phone' => $this->input->post('customer_phone'),
	    		'gross_amount' => $this->input->post('gross_amount_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_amount' => $this->input->post('net_amount_value'),
	    		'discount' => $this->input->post('discount'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('orders', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getOrdersItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('order_id', $id);
			$this->db->delete('orders_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'order_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'rate' => $this->input->post('rate_value')[$x],
	    			'amount' => $this->input->post('amount_value')[$x],
	    		);
	    		$this->db->insert('orders_item', $items);

	    		// now decrease the stock from the product
	    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	    		$update_product = array('qty' => $qty);
	    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}



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
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}