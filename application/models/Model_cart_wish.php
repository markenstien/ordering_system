<?php 

	class Model_cart_wish extends Model_adapter
	{
		public $_table_name = 'cart_wish_items';

		public $_fillables = [
			'id', 'product_id', 'quantity',
			'user_id' , 'cart_type',
			'product_type', 'session',
			'created_at',
			'attr_key_pair'
		];

		public function __construct()
		{
			parent::__construct();
		}

		public function setUser( $user )
		{
			$this->user = $user;
		}

		public function addItem( $item_data )
		{
			$token = $this->getToken();

			if( $this->productExistInCartError($item_data['product_id'], $token) ) 
				return false;

			$item_data['session'] = $token;

			$_fillables = $this->getFillablesOnly($item_data);
			//check if has stock

			if( isset($item_data['attr']) ) 
				$_fillables['attr_key_pair'] = json_encode( $item_data['attr'] );

			
			if( !$this->stock->canSupplyOrderQuantity($_fillables['product_id'], $_fillables['quantity']) ){
				$this->addError($this->stock->getErrorString());
				return false;
			}
			return $this->create( $_fillables );
		}

		public function updateItem($item_data , $id)
		{
			$_fillables = $this->getFillablesOnly($item_data);

			if( isset($item_data['attr']) ) 
				$_fillables['attr_key_pair'] = json_encode( $item_data['attr'] );

			return $this->update( $_fillables , $id);
		}

		public function updateMultiple( $item_data )
		{
			$is_ok = true;

			if( isset($item_data['item']) )
			{
				$item = $item_data['item'];

				foreach($item as $key => $row) 
				{
					$is_ok = $this->update([
						'quantity' => intval($row['quantity'])
					] , $row['id']);
				}
			}

			return $is_ok;
		}

		/*
		*get token
		*/
		public function getToken()
		{
			$session = null;
			//then user is logged in
			if( $user_cart = $this->getUsercart() )
				$session = $user_cart[0]['session'];

			return $this->startToken($session);
		}

		//get user  specific car-items
		public function getUsercart($user_id = null)
		{		
			if( ! is_null($user_id) ){
				return $user_session = $this->getAll([
					'where' => [
						'user_id' => $this->user['id'],
						'cart_type' => 'cart'
					]
				]);
			}

			if( isset( $this->user) )
			{
				$user_session = $this->getAll([
					'where' => [
						'user_id' => $this->user['id'],
						'cart_type' => 'cart'
					]
				]);

				if($user_session)
					return $user_session;
			}

			return false;
		}

		/*
		*get current active cart
		*/
		public function getActiveCart()
		{
			$token = $this->getToken();

			return $this->getAll([
				'where' => [
					'session' => $token,
					'cart_type' => 'cart'
				]
			]);
		}

		public function getItem($id)
		{
			return $this->getAll([
				'where' => [
					'ci.id' => $id,
					'session' => $this->getToken()
				]
			])[0] ?? false;
		}

		/*
		*save token to session
		*/
		public function startToken( $session = null)
		{
			/*
			*check if naka login
			*pag naka login hanap cart_item pag wala create token
			*if walang login create ng token simple
			*/
			if( ! is_null($session) ){
				$_SESSION['cart_token'] = $session;
			}elseif(!isset($_SESSION['cart_token']) ){
				$_SESSION['cart_token'] = generateRandomString(20);
			}

			return $_SESSION['cart_token'];
		}

		public function deleteCartItems( $session = null )
		{
			$delete_this_session = null;
			if( !is_null($session) ){
				$delete_this_session = $session;
			}else{
				$delete_this_session = $this->getToken();
			}

			return parent::deleteKeyPair([
				'session' => $delete_this_session,
				'cart_type' => 'cart'
			]);
		}

		public function killToken()
		{
			if( isset($_SESSION['cart_token']) ){
				unset( $_SESSION['cart_token'] );
			}

		}

		public function productExistInCartError($product_id , $session)
		{

			$exists = parent::getRow([
				'product_id' => $product_id,
				'session'    => $session,
			]);

			if($exists){
				$this->addError("Product Already exists in cart");
				return true;
			}

			return false;
		}


		public function getAll($params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert($params['where']) ;

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			$results = $this->queryResultArray(
				"SELECT product.* , ci.* , ci.id as id 
					FROM {$this->_table_name} as ci
					LEFT JOIN products as product 
					ON product.id = ci.product_id

					{$where} {$order}"
			);

			foreach($results as $key => $res) {
				$results[$key]['attr_key_pair'] = json_decode($res['attr_key_pair']);
			}

			return $results;
		}
	}