drop table if exists return_orders;
create table return_orders(
	id int(10) not null primary key auto_increment,
	reference varchar(50),
	order_id int(10) not null,
	user_id int(10) not null,
	status enum('pending' , 'returned' , 'invalid' , 'for-checking') default 'pending',
	reason text,

	updated_by int(10) ,
	returned_amount decimal(10,2),
	rermarks text,
	created_at timestamp default now()
);