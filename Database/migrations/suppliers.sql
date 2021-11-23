create table suppliers(
	id int(10) not null primary key auto_increment,
	name varchar(100),
	product varchar(100),
	phone varchar(100),
	email varchar(100),
	contact_name varchar(100),
	website varchar(100),
	notes text,
	status enum('terminated' , 'active') default 'active',
	date_start date,
	created_by int(10),
	created_at timestamp default now()
);