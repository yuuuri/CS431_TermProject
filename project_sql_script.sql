create database TermProject;

use database TermProject;

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


;
create table STUDENT
(	S_ID int unsigned not null primary key,
	Fname char (50) not null,
	Lname char (50) not null
);

create table COURSE
(	Course_ID int unsigned not null primary key,
	Course_Title char (10),
	Description char (100)
);

create table SECTIONS
(	Section_ID int unsigned not null primary key,
	Course_ID int unsigned not null,
	P_ID int unsigned not null,
	Meeting_Date char (50),
	Start_Time char (50),
	Syllabus mediumblob
);

alter table SECTIONS
add foreign key (P_ID) references PROFESSOR (P_ID)
add foreign key (Course_ID) references COURSE (Course_ID);


create table ENROLL
(	S_ID int unsigned not null,
	Section_ID int unsigned not null
);

alter table ENROLL
add foreign key (S_ID) references STUDENT (S_ID)
add foreign key (Section_ID) references SECTIONS (Section_ID);

create table CLASS_GRADES
(	Section_ID int unsigned not null,
	S_ID int unsigned not null,
	HW mediumblob,
	Term_Project mediumblob,
	Course_Grade float
);
