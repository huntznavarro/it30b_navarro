 create table students (student_ID INT AUTO_INCREMENT PRIMAREY KEY  
            , Student_Name varchar (50) NOT NULL
            ,Student_Age int (10)
            , Student_last_name varchar (50) NOT NULL,
        );

create table booking (booking_id int (10));





    CREATE TABLE student (
    Student_id int(11) NOT NULL,
    First_Name varchar(50) DEFAULT NULL,
    Last_Name varchar(50) DEFAULT NULL,
    Age int(10) DEFAULT NULL
    );



    CREATE TABLE borrow (
    Borrow_ID int(11) NOT NULL,gio
    Student_ID int(10) NOT NULL,
    Book_ID int(10) NOT NULL,
    Borrow_Date date NOT NULL,
    Due_Date date NOT NULL,
    Return_Date date DEFAULT NULL,
    Status varchar(255) DEFAULT NULL
    );




    CREATE TABLE books (
    Book_ID int(11) NOT NULL,
    Title varchar(255) DEFAULT NULL,
    Author varchar(255) DEFAULT NULL,
    Published_Year date DEFAULT NULL
    );
