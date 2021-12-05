alter table users
	add column user_type enum('employee','customer') default 'employee',
	add column address text;


alter table users
	add column is_verified boolean default true;