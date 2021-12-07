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
		if($id) 
		{
			$product = $this->getAll([
				'where' => " product.id = '{$id}' "
			])[0] ?? false;

			//get attributes

			$attributes = $this->extractAttributes($product['attribute_value_id']);
			$categories = $this->extractCategories($product['category_id']);


			$product['category_extracted'] = $categories;
			$product['attr_extracted'] = $attributes;
			
			return $product;
		}

		return $this->getAll([
			'where' => " product.id = '{$id}' ",
			'orderby' => 'id desc'
		]);
	}

	public function extractCategories($categories)
	{
		if( $categories )
		{
			$category_extracted = [];

			$categories = json_decode($categories);

			if(!$categories)
				return [];
			
			foreach($categories as $cat_id)
			{
				$cat_exists = $this->dbrow('categories', $this->conditionConvert([
					'id' => $cat_id
				]));

				if($cat_exists)
					array_push($category_extracted ,   $cat_exists);
			}

			return $category_extracted;
		}

		return [];
	}

	public function extractAttributes($attributes)
	{
		if( $attributes ) 
		{
			$attr_extracted = [];

			$attributes = json_decode($attributes);	

			if(!$attributes)
				return [];

			foreach($attributes as $key => $attr_id) 
			{
				$attribute = $this->dbrow('attribute_value' , $this->conditionConvert([
					'id' => $attr_id
				]));

				if( $attribute )
				{
					if(!isset($attr_extracted[$attribute['attribute_parent_id']]) ){
						$attr_extracted[$attribute['attribute_parent_id']] = ['values' => [] , 'attribute' => null];
					}
					array_push($attr_extracted[$attribute['attribute_parent_id']]['values'] , $attribute);
				}
			}
			//key is the parent
			foreach($attr_extracted as $key=> $attr) 
			{
				$attr_extracted[$key]['attribute'] = $this->dbrow('attributes' , $this->conditionConvert([
					'id' => $key
				]));
			}

			return $attr_extracted;
		}

		return [];
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
		$_fillables['sku'] = $this->generateSku();

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

	public function generateSku()
	{
		$sku = null;

		while( is_null($sku) )
		{
			$sku = strtoupper("SKU-".generateRandomString(5));
			//check if sku exists
			$is_exists = parent::getRow([
				'sku' => $sku
			]);

			if($is_exists)
				$sku = null;//reset
		}

		return $sku;
	}

}