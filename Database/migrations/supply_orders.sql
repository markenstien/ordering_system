drop table supply_orders;
create table supply_orders(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	title varchar(100),
	supplier_id int(10),
	date date,
	amount decimal(10 ,2),
	budget decimal(10 ,2),
	balance decimal(10 ,2),
	status enum('pending', 'delivered' , 'cancelled'),
	payment_status enum('paid','partially-paid'),
	description text,
	created_by int(10),
	created_at timestamp default now()
);