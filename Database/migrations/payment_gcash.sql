create table payment_gcash(
	id int(10) not null primary key auto_increment,
	reference varchar(100),

	order_id int(10) not null comment 'considerably as bill_id',
	account_name varchar(100),
	account_number varchar(100),
	reference_number varchar(100),
	amount_paid decimal(10,2),
	image_src text,
	user_id int(10),
	validation_status enum('pending','invalid' , 'valid') default 'pending',
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);