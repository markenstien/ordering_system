<?php 

class Model_products extends Model_adapter
{
	public $_table_name = 'products';

	public $_fillables = [
		'id' , 'name',
		'sky', 'price',
		'qty', 'image',
		'description' , 'attribute_value_id','category_id',
		'availability' , 'min_stock' , 'max_stock'
	];
	
	public function getAll( $params = [])
	{
		$where = null;
		$orderby = null;

		if( isset($params['where']) )
			$where = " WHERE ". $this->conditionConvert($params['where']);

		if( isset($params['orderby']) )
			$orderby = " ORDER BY {$params['orderby']} ";

		return parent::queryResultArray(
			"SELECT product.* , 
				(SELECT ifnull(sum(quantity) , 0) 
					FROM stocks as stock 
					WHERE stock.product_id = product.id
					GROUP BY product_id 
				) as stock_quantity
				FROM {$this->_table_name} as product

				{$where} {$orderby}
			"
		);

	}

	public function getTotalAmount( $products )
	{
		$total = 0;
		foreach($products as $product) {
			$total += $products['price'];
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
		return $this->getAll([
			'where' => ['availability' => 1]
		]);
	}

	public function create($data)
	{
		$_fillables = $this->getFillablesOnly($data);

		return parent::create($_fillables);
	}

	public function update($data, $id)
	{
		$_fillables = $this->getFillablesOnly($data);

		return parent::update($_fillables , $id);
	}

	public function remove($id)
	{
		return parent::delete($id);
	}

	public function countTotalProducts()
	{
		return parent::queryResultSingle("SELECT count(id) as total FROM products")['total'] ?? 0;
	}

}