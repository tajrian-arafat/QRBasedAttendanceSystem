begin;
set transaction read write;

CREATE TABLE qr_admins (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  password VARCHAR NOT NULL
);

CREATE TABLE qr_attendance_data (
  id SERIAL PRIMARY KEY,
  student_id integer NOT NULL,
  section_id integer NOT NULL,
  date VARCHAR NOT NULL,
  attendance integer NOT NULL DEFAULT 0,
  device_id VARCHAR DEFAULT NULL
);

CREATE TABLE qr_courses (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL
);

CREATE TABLE qr_sections (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL,
  course_id integer NOT NULL,
  teacher_id integer NOT NULL
);

CREATE TABLE qr_students (
  id SERIAL PRIMARY KEY,
  student_id VARCHAR NOT NULL,
  name VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  password VARCHAR NOT NULL,
  section_ids VARCHAR DEFAULT NULL,
  device_id VARCHAR DEFAULT NULL
);

CREATE TABLE qr_teachers (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  password VARCHAR NOT NULL
);

CREATE TABLE qr_validation_storage (
  id SERIAL PRIMARY KEY,
  create_datetime VARCHAR NOT NULL,
  qr_hash VARCHAR NOT NULL,
  qr_section_id integer NOT NULL
);

insert  into qr_admins(id,name,email,password) values 
(1,'Admin 1','admin@gmail.com','1234abcd');

insert  into qr_courses(id,name) values 
(1,'CSE370'),
(2,'CSE320'),
(3,'CSE330'),
(4,'CSE250'),
(5,'CSE331');

insert  into qr_sections(id,name,course_id,teacher_id) values 
(1,'Section 1',1,3),
(2,'Section 2',1,3),
(3,'Section 1',2,3),
(4,'Section 2',2,4),
(5,'Section 1',3,3),
(6,'Section 2',3,4),
(7,'Section 1',4,3),
(8,'Section 2',4,4),
(9,'Section 1',5,3),
(10,'Section B',5,4);

insert  into qr_students(id,student_id,name,email,password,section_ids,device_id) values 
(1,'20201186','Alvi','alvi@gmail.com','','\"3\",\"6\",\"7\",\"9\"',NULL),
(2,'20201022','Sabiha','sabiha@gmail.com','','\"1\",\"3\",\"6\",\"7\",\"10\"',NULL),
(3,'20201047','Sharif','sharif@gmail.com','','\"2\",\"4\",\"6\",\"7\",\"9\"',NULL),
(4,'20211021','Hasib','hasib@gmail.com','','\"1\",\"3\",\"5\",\"8\",\"9\"',NULL),
(5,'40000004','Shihab','shihab@gmail.com','','\"1\",\"4\",\"5\",\"7\",\"9\"',NULL);

commit;




