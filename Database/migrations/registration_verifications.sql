create table registration_verifications(
	id int(10) not null primary key auto_increment,
	email varchar(100) not null,
	user_id int(10) not null,
	code char(4) not null,
	status enum('pending' , 'completed' , 'expired')  default 'pending',
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);