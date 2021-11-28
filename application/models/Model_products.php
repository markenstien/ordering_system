<?php 

class Model_products extends CI_Model
{
	public $_table_name = 'products';

	public function __construct()
	{
		parent::__construct();
	}


	public function getAll( $params = [])
	{
		$where = null;
		$orderby = null;

		if( isset($params['where']) )
			$where = " WHERE ". $params['where'];

		if( isset($params['orderby']) )
			$orderby = " ORDER BY {$params['orderby']} ";

		$query = $this->db->query(
			"SELECT product.* , 
				(SELECT ifnull(sum(quantity) , 0) 
					FROM stocks as stock 
					WHERE stock.product_id = product.id
					GROUP BY product_id 
				) as quantity
				FROM {$this->_table_name} as product

				{$where} {$orderby}
			"
		);

		return $query->result_array();
	}

	public function getTotalAmount( $products )
	{
		$total = 0;
		foreach($products as $product) {
			$total += $products->price;
		}

		return $total;
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if($id) {
			return $this->getAll([
				'where' => " product.id = '{$id}' "
			])[0] ?? false;
		}

		return $this->getAll([
			'where' => " product.id = '{$id}' ",
			'orderby' => 'id desc'
		]);
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM products WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}