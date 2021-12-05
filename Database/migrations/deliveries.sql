drop table if exists deliveries;
create table deliveries(
	id int(10) not null primary key auto_increment,
	reference varchar(100),

	order_id int(10) not null,
	user_id int(10) not null,
	date date,


	cx_name varchar(100),
	cx_email varchar(100),
	cx_phone varchar(100),
	cx_address text,
	description text,

	received_by varchar(100),
	status enum('pending','for-delivery','delivered' , 'cancelled'),
	remarks text,


	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);