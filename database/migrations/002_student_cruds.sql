

SELECT * from students;

-- students SQL#2 : SELECT students in async by student_id

SELECT * FROM students
    ORDER BY student_id ASC;
-- students SQL#3 : SELECT students in DESC by student_id

SELECT * FROM students
    ORDER BY student_id DESC;

-- students SQL#4 : SELECT students in async

SELECT * FROM students
    ORDER BY student_last_name ASC;

-- students SQL#5 : SELECT students in DESC by last name

SELECT * FROM students
    ORDER BY student_last_name DESC;

-- students SQL#4 : SELECT students in async by first_name

SELECT * FROM students
    ORDER BY student_first_name ASC;

-- students SQL#5 : SELECT students in DESC order by first_name

SELECT * FROM students
    ORDER BY student_first_name DESC;

-- you can modify displayed columns by selecting
-- specific columns after SELECT command
-- student SQL#8 display all the students first_name  and last_name

SELECT student_first_name,
        student_last_name
    FROM students
    ORDER BY student_first_name ASC;

-- student SQL#9 LIMIT-1 you can  change all the limit to any number
    SELECT student_first_name,
        student_last_name
    FROM students
    ORDER BY student_first_name ASC
    LIMIT 2;

-- student SQL#10 - select  based on id
SELECT student_first_name,
        student_last_name
    FROM students
    WHERE student_id = 1
    LIMIT 1;
    
-- student SQL#10 - select  based on id
UPDATE students 
SET student_first_name='rebo',
    student_last_name='Orravan'
WHERE  student_id=2;



SELECT * FROM students
    ORDER BY book_id ASC;

    SELECT * FROM students
    ORDER BY book_id DESC;


    SELECT * FROM students
    ORDER BY book_author ASC;


    SELECT * FROM students
    ORDER BY book_author DESC;

    SELECT book_title,
        book_author
    FROM books
    ORDER BY student_first_name ASC;


    SELECT book_title,
        book_author,
        book_category

    FROM students
    WHERE student_id = 1
    LIMIT 1;



    SELECT book_title,
        book_author,
        book_category
    FROM students
    ORDER BY student_first_name ASC
    LIMIT 2;


    UPDATE books
SET book_title='NOLIME TANGERE',
    book_author='JOSE RIZAL'
WHERE  book_id=2;


