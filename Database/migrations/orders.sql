ALTER table orders
	add column origin enum('online' , 'walk-in') default 'walk-in',
	add column customer_email varchar(100);


ALTER TABLE orders 
	add column delivery_status enum('pending' , 'for-delivery' , 'cancelled' , 'delivered' , 'walk-in') default 'pending';



ALTER TABLE orders
	add column remarks text;


ALTER TABLE orders
	add column order_status enum('completed' , 'cancelled') default 'completed';


alter table orders_item
	add column attr_key_pair text;