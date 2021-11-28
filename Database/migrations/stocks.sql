create table stocks(
	
	id int(10) not null primary key auto_increment,
	product_id int(10),
	quantity int,
	description text,
	date date,

	purchase_order_id int(10) comment 'only if there is a purchase order_id',
	created_by int(10),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);