create table product_bundle_items(
	id int(10) not null primary key auto_increment,
	product_id int(10) not null,
	bundle_id int(10) not null,
	created_at timestamp default now()
);