alter table users
	add column user_type enum('employee','customer') default 'employee',
	add column address text;


alter table users
	add column is_verified boolean default true;

alter table users
	add column toc_agreed boolean default false;



alter table users
	add column adrs_street text,
	add column adrs_block_no text,
	add column adrs_barangay text,
	add column adrs_city text,
	add column adrs_zip text;