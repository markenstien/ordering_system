drop table if exists product_bundle_items;
create table product_bundle_items(
	id int(10) not null primary key auto_increment,
	product_id int(10) not null,
	bundle_id int(10) not null,
	quantity int(10),
	created_at timestamp default now()
);