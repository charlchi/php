CREATE TABLE ft_table {
	id int PRIMARY KEY NOT_NULL AUTOINCREMENT,
	login varchar(7) default 'toto' NOT NULL,
	group ENUM('staff', 'student', 'other') NOT NULL,
	creation_date DATE NOT NULL
}