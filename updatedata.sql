create database TermProject;

use TermProject;

create table ADMIN_STAFF
(	A_ID int unsigned not null primary key,
	Fname char (50) not null,
	Lname char (50) not null
);

create table PROFESSOR
(	P_ID int unsigned not null primary key,
	Fname char (50) not null,
	Lname char (50) not null
);


create table STUDENT
(	S_ID int unsigned not null primary key,
	Fname char (50) not null,
	Lname char (50) not null
);

create table COURSE
(	Course_ID char (10) not null primary key,
	Course_Title char (30),
        Course_Unit int unsigned not null,
	Description varchar (500)
);

create table SECTIONS
(	Section_ID int unsigned not null primary key,
	Course_ID char (10) not null,
	P_ID int unsigned not null,
	Meeting_Date char (50),
	Start_Time char (50),
	End_Time char (50),
	Syllabus mediumblob
);

alter table SECTIONS
add foreign key (P_ID) references PROFESSOR (P_ID),
add foreign key (Course_ID) references COURSE (Course_ID);


create table ENROLL
(	 
	S_ID int unsigned not null,
	Section_ID int unsigned not null
);

alter table ENROLL
add foreign key (S_ID) references STUDENT (S_ID),
add foreign key (Section_ID) references SECTIONS (Section_ID);

CREATE TABLE `FILE` (
    `hw_id`     int unsigned not null auto_increment,
    `S_ID`		int unsigned not null,
    `Section_ID`	int unsigned not null,
    `name`      varchar(255) not null default 'Untitled.txt',
    `mime`      varchar(50) not null default 'text/plain',
    `size`      bigint Unsigned not null default 0,
    `data`      mediumblob not null,
    `created`   datetime not null,
    primary key (`hw_id`)
);

alter table FILE
add foreign key (S_ID) references ENROLL (S_ID),
add foreign key (Section_ID) references ENROLL (Section_ID);
 
create table CLASS_GRADES
(	Section_ID int unsigned not null,
	S_ID int unsigned not null,
	HW mediumblob,
	Term_Project mediumblob,
	HW_Grade float,
	Term_Grade float,
	Course_Grade float
);


insert into ADMIN_STAFF values
(	100000001, 'John', 'Doe'),
(	100000002, 'Jane', 'Smith');


insert into PROFESSOR values
(	200000011, 'Bruce', 'Wayne'),
(	200000012, 'Clark', 'Kent'),
(	200000013, 'Houston', 'Street'),
(	200000014, 'Kenny', 'Avory'),
(	200000015, 'Donna', 'Kostner');

insert into STUDENT values
(	300000001, 'Charles', 'Xavier'),
(	300000002, 'Hope', 'Summers'),
(	300000003, 'Bobby', 'Schmurda'),
(	300000004, 'Barbara', 'Sorasit'),
(	300000005, 'Civic', 'Honda'),
(	300000006, 'Collora', 'Toyota'),
(	300000007, 'Lexus', 'Andrade');

insert into COURSE values
(	'CPSC-431', 'Database & Applications', 3,'Class specifies PHP and MySQL.  Pre-reqs include CPSC 131'),
(	'CPSC-471', 'Computer Communications', 3, 'Learn about wireshark and how packets move through a network!'),
(	'CPSC-440', 'Computer System Architecture', 3, 'If you loved programming in assembly language, you will really love this class'),
(	'CPSC-462', 'Software Designs', 3, 'Concepts of software modeling, software process and some tools. Object-oriented analysis.'),
(	'CPSC-473', 'Web Programming and Data Management', 3, 'Various techniques for developing Web-based database applications using software engineering
methodology. Introduce concept and architecture of Web servers, Web database design
techniques, client/server side programming, and Web application tools and techniques. '),
(	'CPSC-481', 'Artificial Intelligence', 3, 'Use of computers to simulate human intelligence. Topics include production systems, pattern
recognition, problem solving, searching game trees, knowledge representation, and logical
reasoning. Programming in AI environments.');

insert into SECTIONS values
(	00001, 'CPSC-431', 200000011, 'Tu/Th', '10:00 AM', '11:30 AM', ''),
(	00002, 'CPSC-431', 200000011, 'Tu/Th', '2:00 PM', '3:30 PM', ''),
(	00003, 'CPSC-471', 200000012, 'M/W', '12:00 PM', '1:30 PM', ''),
(	00004, 'CPSC-471', 200000012, 'M/W', '4:00 PM', '5:30 PM', ''),
(	00005, 'CPSC-440', 200000012, 'Tu/Th', '12:00 PM', '1:30 PM', ''),
(	00006, 'CPSC-462', 200000013, 'M/W', '2:00 PM', '3:15 PM', ''),
(	00007, 'CPSC-473', 200000014, 'W', '7:00 PM', '9:45 PM', ''),
(	00008, 'CPSC-481', 200000015, 'M/W', '4:00 PM', '5:15 PM', '');

insert into ENROLL values
(	300000001, 00001),
(	300000002, 00001),
(	300000001, 00003),
(	300000001, 00005),
(	300000003, 00001),
(	300000004, 00007),
(	300000005, 00007),
(	300000006, 00007),
(	300000007, 00007);

insert into CLASS_GRADES (Section_ID, S_ID, HW_Grade, Term_Grade) values
(	00001, 300000001, 100, 88),
(	00001, 300000002, 92, 80),
(	00007, 300000004, 54, 98),
(	00007, 300000005, 98, 50),
(	00007, 300000006, 64, 88),
(	00007, 300000007, 78, 84);
