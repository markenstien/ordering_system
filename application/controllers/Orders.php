<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');

		$this->load->model('model_stock');
		$this->load->model('model_delivery');
		$this->load->model('model_payment');

		$this->load->model('model_payment_gcash');
		$this->load->model('model_notification');


		$this->model_orders->injectModels([
			'model_stock' => $this->model_stock,
			'model_payment' => $this->model_payment
		]);

		$this->model_payment_gcash->injectModels([
			'model_payment' => $this->model_payment,
			'model_notification' => $this->model_notification
		]);
	}

	// public function forDelivery($order_id)
	// {
		
	// }

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		$this->data['page_title'] = 'Manage Orders';

		if( isEqual($this->data['user_data']['user_type'] , 'customer') )
		{
			$this->data['orders'] = $this->model_orders->getAll([
				'where' => [
					'user_id' => $this->data['user_data']['id']
				],
				'order' => ' id desc '
			]);
		}else{
			$this->data['orders'] = $this->model_orders->getAll([
				'order' => ' id desc '
			]);
		}
		
		$this->render_template('orders/index', $this->data);		
	}

	public function show( $id )
	{
		$order = $this->model_orders->getOrderWithItems($id);

		$delivery = $this->model_delivery->getByOrder($id);

		$this->data['order'] = $order;
		$this->data['items'] = $order['items'];

		$this->data['payment'] = $this->model_payment->getAll(['where' => ['payment.order_id' => $id]])[0] ?? false;
		$this->data['delivery'] = $delivery;

		$this->data['payment_gcash'] = $this->model_payment_gcash->getByOrder( $order['id'] );

		$this->data['is_editable'] = isEqual($order['order_status'] , 'completed') ? true : false;

		return $this->render_template('orders/show' , $this->data);
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('orders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if( $value['origin'] == 'online' )
				$buttons .= ' <a href="'.base_url('delivery/create/'.$value['id']).'" class="btn btn-default"><i class="fa fa-truck"></i></a>';

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$value['origin'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function cancel()
	{
		if( isSubmitted() )
		{
			$post = $_POST;

			$res = $this->model_orders->cancel( $post );

			if($res) {
				flash_set( $this->model_orders->getMessageString() );
			}else{
				flash_set( $this->model_orders->getErrorString() , 'danger' );
			}

			return redirect('orders/show/'.$post['order_id']);
		}

		// $this->model_orders->cancel($id);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) 
        {   

        	$_POST['net_amount'] = $_POST['net_amount_value'];

        	$order_id = $this->model_orders->create( $_POST  );

        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		if( isSubmitted() )
		{
			$items = [];

			if( !isset($_POST['product']) || empty($_POST['product']) )
			{
				flash_set("Invalid Order");
				return redirect('orders/update/'.$id);
			}

			foreach($_POST['product'] as $index => $prd)
			{
				array_push($items, [
					'product_id' => $_POST['product'][$index],
					'qty'  => $_POST['qty'][$index],
					'rate' => $_POST['rate_value'][$index],
					'amount' => $_POST['amount_value'][$index]
				]);
			}

			$this->model_orders->injectModels([
				'model_stock' => $this->model_stock
			]);

			$res = $this->model_orders->updateWithItems([
				'id'   => $id,
				'customer_name' => $_POST['customer_name'],
				'customer_address' => $_POST['customer_address'],
				'customer_phone' => $_POST['customer_phone'],
				'net_amount' => $_POST['net_amount_value'],
			] , $items);

			if($res) {
				flash_set( $this->model_orders->getMessageString() );
				return redirect('orders/update/'.$id);
			}else{
				flash_set( $this->model_orders->getErrorString() , 'danger');
				return redirect('orders/udpate/'.$id);
			}
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        $company = $this->model_company->getCompanyData(1);
    	$this->data['company_data'] = $company;
    	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
    	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

    	$result = array();
    	$orders_data = $this->model_orders->getOrdersData($id);

		$result['order'] = $orders_data;
		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

		foreach($orders_item as $k => $v) {
			$result['order_item'][] = $v;
		}

		$this->data['order_data'] = $result;

    	$this->data['products'] = $this->model_products->getActiveProductData();      	

        $this->render_template('orders/edit', $this->data);
	}


	public function reOrder( $order_id )
	{
		if( isSubmitted() )
		{
			$order_id = $_POST['order_id'];

			$res = $this->model_orders->reOrder($order_id , $_POST['items']);

			if($res) {
				flash_set("Return Order successfull {$this->model_orders->bill_no}");
				return redirect('orders/show/'.$res);
			}else{
				flash_set( $this->model_orders->getErrorString() , 'danger');
			}
		}
			
		$order = $this->model_orders->getOrderWithItems($order_id);

		$this->data['order_id'] = $order_id;
		$this->data['order'] = $order;

		return $this->render_template('orders/return_order' , $this->data);
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Bake and Wrap | Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$order_data['bill_no'].'<br>
			        <b>Name:</b> '.$order_data['customer_name'].'<br>
			        <b>Address:</b> '.$order_data['customer_address'].' <br />
			        <b>Phone:</b> '.$order_data['customer_phone'].'
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Price</th>
			            <th>Qty</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>'.$v['rate'].'</td>
				            <td>'.$v['qty'].'</td>
				            <td>'.$v['amount'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Gross Amount:</th>
			              <td>'.$order_data['gross_amount'].'</td>
			            </tr>';

			            if($order_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
				              <td>'.$order_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($order_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>'.$order_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$order_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$order_data['net_amount'].'</td>
			            </tr>
			            <tr>
			              <th>Paid Status:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}