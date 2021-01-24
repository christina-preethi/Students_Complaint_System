create database complaints_system;
set SQL_SAFE_UPDATES = 0;
use  complaints_system;

create table student (
	reg_no varchar(20) primary key,
	name varchar(20),
    user_id varchar(20),
    password varchar(20),
    dept varchar(10),
    year varchar(5),
    section varchar(5)
);


desc student; 

create table tickets (
	ticket_no varchar(20) not null primary key,
	reg_no varchar(20) not null,
    title varchar(50),
    body varchar(250),
    date timestamp,
    severity int,
    faculty_id varchar(20),
    status varchar(20),
    foreign key(reg_no) references student(reg_no),
    foreign key(faculty_id) references faculty(faculty_id),
    constraint chk_status check
    (status in ('RESOLVED', 'WIP', 'STUDENT_PENDING', 'FACULTY_PENDING', 'ASSIGNED')),
    constraint chk_severity check
    (severity in (1, 2, 3, 4, 5))
);

insert into tickets(ticket_no, reg_no, title, body, date, severity, faculty_id, status) values 
('1', '318126510039', 'homework', 'Sir is giving daily homework', now(), 5, '9813', 'ASSIGNED'),
('2', '318126510038', 'extra class', 'You are taking too many extra classes', now(), 3, '9812', 'RESOLVED'), 
('3', '318126510136', 'no duster', 'We do not have a duster in our class', now(), 3, '8973', 'STUDENT_PENDING'),
('4', '320126510347', 'corrupted projector', 'Projector was corrupted a week ago', now(), '3', '8712', 'ASSIGNED'),
('5', '320126510527', 'library books', 'wanted more than 4 books', now(), '3', '6752', 'FACULTY_PENDING');

desc tickets;
select * from tickets;

create table correspondence (
	id varchar(10),
	ticket_no varchar(20),
    messgae varchar(300),
    reg_no varchar(20),
    faculty_id varchar(20),
    date date,
    foreign key(reg_no) references student(reg_no),
	foreign key(faculty_id) references faculty(faculty_id),
    foreign key(ticket_no) references tickets(ticket_no)
);

insert into correspondence values
('1', '3', 'please provide duster for class 3/4 CSE-A', '318126510136', '8973', now());

select * from correspondence;

create table faculty(
	faculty_id varchar(20) primary key,
    faculty_name varchar(20),
    password varchar(20),
    yrs_experience int,
	designation varchar(20),
    qualification varchar(30),
    dept varchar(10)
);

show tables;

desc faculty;

insert into student(reg_no, name, user_id, dept, year, section, password) values 
('318126510038', 'Kalyani', 'kalyani_nk','CSE', '3/4', 'A', 'abcd'),
('318126510039', 'Christina', 'christina_ncp', 'CSE', '3/4', 'B', 'efgh'),
('318126510136', 'Udaya', 'udaya_n','IT', '3/4', 'C', 'qwerty'),
('319126510215', 'Sowjanya', 'sowji_15','ECE', '2/4', 'A', 'asdfg'),
('320126510347', 'Meghana', 'meghana_47', 'Mech', '1/4', 'D', 'yuiop'),
('318126510406', 'Jyothee', 'jyothee_06', 'Chem', '3/4', 'B', 'wxyz'),
('320126510527', 'Preethi', 'preethi_27','EEE', '1/4', 'C', 'lmnop'),
('319126510658', 'Lohith', 'lohith_58', 'Civil', '2/4', 'A', 'ijkl');

desc student;

select * from student;

insert into faculty(faculty_id, faculty_name, password, yrs_experience, designation, qualification, dept) values
('9812', 'Gowri Pushpa', 'asdfg',5, 'asst prof.', 'M.Tech', 'CSE'),
('9813', 'Lokeshwari','mnop', 5, 'asst prof.', 'M.Tech', 'CSE'),
('8973', 'Madhuri', 'qwer', 3, 'asst prof.', 'M.Tech', 'ECE'),
('8712', 'Kiran', 'abnm', 10, 'prof.', 'Ph.D', 'Mech'),
('7812', 'Kumar', 'hello', 16, 'prof.', 'Ph.D', 'Chem'),
('6752', 'Divya', 'abcde', 6, 'asst. prof.', 'M.Tech', 'Civil'),
('5674', 'Meena', 'defgh', 2, 'asst. prof.', 'M.Tech', 'IT'),
('6734', 'Anusha', 'hijkl', 3, 'asst. prof.', 'M.Tech', 'EEE');

select * from faculty;


