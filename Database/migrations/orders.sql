ALTER table orders
	add column origin enum('online' , 'walk-in') default 'walk-in',
	add column customer_email varchar(100);

