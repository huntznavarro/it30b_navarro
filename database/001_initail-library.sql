CREATE TABLE IF NOT EXIST students(

    student_id PRIMARY KEY AUTO_INCREMENT,

    student_first_name VACRHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,


    student_course VARCHAR(50) NOT NULL,

    student_created_at TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP




)ENGINE=innoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXIST books(

    book_id INT PRIMARY KEY AUTO_INCREMENT,


    book_title VARCHAR(50) NOT NULL,
    book_author VARCHAR(50) NOT NULL,
    book_category VARCHAR(50) NOT NULL,


    book_created_at TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP



)ENGINE=innoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXIST borrow(

    borrow_id INT AUTO_INCREMENT PRIMARY KEY,


    student_id INT NOT NULL,
    book_id INT NOT NULL,

    --borrow timestamp not null by default
    Borrow_date TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP,

        --borrow return timestamp null by default
        borrow_return_date TIMESTAMP NULL
        DEFAULT NULL,


        --borrow

        CONSTRAINT fk-borrow_student
        FOREIGN KEY (student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,


        CONSTRAINT fk_borrow_book
        FOREIGN KEY (book_id)
        REFERENCES books(book_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

)ENGINE=innoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

--Insert statement#1



    INSERT INTO students(
        student_first_name,
        student_last_name,
        student_course

    ) VALUES

    ('HUNTZ RENDEVER','NAVARRO','BSIT'),
    ('BON GABRIEL','NAVARRO','BSMT'),
    ('REB','NAVARRO','BSCRIM'),
    ('CHRIS','SOLAR','COMSCI');
--Insert statement #2: Insert books


INSERT INTO BOOKS(
    book_title,
    book_author,
    book-category

) VALUES
    ('NOLI ME TANGERE','JOSE RIZAL','HISTORICAL FICTION'),
    ('EL FILIBUSTERSIMO','JOSE RIZAL','HISTORICAL FICTION'),
    ('FLORANTE AT LAURA','FRANCISCO BALAGTAS','FICTION');


    --Insert statement #3 Insert borrow
    INSERT INTO borrow(
        student_id,
        book_id


    ) VALUES
        (1, 2),
        (2,1),
        (2, 3);
