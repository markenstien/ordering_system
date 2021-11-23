create table product_bundles(
	id int(10) not null primary key auto_increment,
	name varchar(100),
	description text,
	price decimal(10 ,2),
	price_custom decimal(10 ,2),
	discount decimal(10 ,2),
	stats enum('available' , 'unavailable') default 'available',
	is_visible boolean default true,
	created_at timestamp default now()
);