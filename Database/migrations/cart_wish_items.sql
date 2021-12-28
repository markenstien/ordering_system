drop table if exists cart_wish_items;
create table cart_wish_items(
	id int(10) not null primary key auto_increment,
	product_id int(10) not null,
	quantity int(10),
	user_id int(10),
	cart_type enum('cart' , 'wish-list'),
	product_type enum('bundle' , 'single'),
	session varchar(100),
	created_at timestamp default now()
);

alter table cart_wish_items
	add column attr_key_pair text;