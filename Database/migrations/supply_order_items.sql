create table supply_order_items(
	id int(10) not null primary key auto_increment,
	supply_order_id int(10),
	product_id int(10),
	quantity int(10),
	damaged_quantity int(10),
	damage_notes text,
	created_by int(10),
	created_at timestamp default now()
);