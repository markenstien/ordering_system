create table supply_orders(
	id int(10) not null primary key auto_increment,
	supplier_id int(10),
	date date,
	amount decimal(10 ,2),
	balance decimal(10 ,2),
	status enum('pending', 'delivered' , 'cancelled'),
	payment_status enum('paid','partially-paid'),
	notes text,
	created_by int(10),
	created_at timestamp default now(),
);