<?php 


	class Model_delivery extends Model_adapter
	{
		public $_table_name = 'deliveries';

		public $_fillables = [
			'id',
			'order_id',
			'user_id',
			'date',
			'cx_name',
			'cx_email',
			'cx_phone',
			'cx_address',
			'description',
			'received_by',
			'status',
			'remarks',
			'created_at',
			'updated_at'
		];

		public function create( $delivery_data )
		{
			$_fillables = $this->getFillablesOnly($delivery_data);

			$_fillables['reference'] = $this->reference();
			$_fillables['status'] = 'pending';

			return parent::create($_fillables);
		}

		public function getComplete($id)
		{
			$delivery = parent::getRow(['id' => $id]);
			$order = $this->model_order->getOrderWithItems($delivery['order_id']);
			
			$delivery['order'] = $order;
			$delivery['order']['items'] = $order['items'];
			
			return $delivery;
		}


		public function getByOrder($order_id)
		{
			return $this->getAll(['delivery.order_id' => $order_id])[0] ?? false;
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ". $this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			return $this->queryResultArray(
				"SELECT delivery.* , bill_no
					FROM {$this->_table_name} as delivery
					LEFT JOIN orders  
					ON orders.id = delivery.order_id
					{$where} {$order}"
			);
		}

		public function reference()
		{
			return strtoupper('DLVRY-'.generateRandomString(8));
		}

		public function updateStatus($status_data , $id)
		{
			$_fillables = $this->getFillablesOnly($status_data);

			//update orders
			$res = parent::update($_fillables , $id);

			if($res) 
			{	
				$delivery = parent::get($id);

				$this->model_order->updateDeliveryStatus($_fillables['status'], $delivery['order_id']);
			}

			return true;
		}
	}