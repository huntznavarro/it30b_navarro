CREATE DATABASES < databases_name.;
show databases;
connect <databases_name>;
CREATE TABLE <table_name_in_plural> (
INSERT INTO <table_name_in_plural>
            (column) Values
            (Values);

);



#Utility Commands
\! cls

mysqldump -u root -p --databases library_dodo > C:\xampp\htdocs\dev\backups1\081826_library_dodo.sql
mysqldump -u root -p --databases library_dodo > "C:\xampp\htdocs\it30b_navarro\backups1\%date:~-4%%date:~3,2%%date:~0,2%_%time:~0,2%%time:~3,2%%time:~6,2%_library_dodo.sql"


SELECT br.borrow_id, s.student_id
     CONCAT(s.student_first_name, '', s.student_last_name) AS student_name, student_course,
     b.book_title, b.book_author, b.book_category,
     br.borrow_date FROM borrow br
     JOIN students s ON br.student_id = b.book_id
    JOIN books b ON br.book_id = b.book_id
     ORDER BY br.borrow_date DESC;


SELECT  br.borrow_id,s.student_id,
    CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
    s.student_course,b.book_title,b.book_author,b.book_category,
    br.borrow_date FROM borrow br
    JOIN students s ON br.student_id = s.student_id
    JOIN books b ON br.book_id = b.book_id
    ORDER BY br.borrow_date DESC;



    INSERT INTO books(book_title,book_author,book_category) VALUES
    ("Lord of the Ring","JR Tolkien","Fantasy"),
    ("Jurrasic","Micheal Crichton","Science Fiction"),
    ("1984","George Orwell","Science FIction");


    INSERT INTO books(book_title,book_author,book_category) VALUES
    ("HARRY POTTER","JOANE ROWLING","SCIFI");



    SELECT
         br.borrow_id,
        CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
        s.student_course,
       b.book_title,
        b.book_author,
        b.book_category,
         br.borrow_date
     FROM borrow br
     JOIN students s ON br.student_id = s.student_id
     JOIN books b ON br.book_id = b.book_id
     ORDER BY br.borrow_date DESC;


      INSERT INTO borrow(student_id,book_id) VALUES
     (1,1),
    (1,2),
    (3,2);

    git commit  added queries for  borrow and return

    