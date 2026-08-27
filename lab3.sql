SELECT  br.borrow_id, s.student_id,
    CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
    b.book_title, b.book_author, b.book_category,
    br.borrow_date,br.borrow_return_date
 FROM borrow br
    JOIN students s ON br.student_id = s.student_id
    JOIN books b ON br.book_id = b.book_id
    WHERE br.borrow_return_date IS NOT NULL
    ORDER BY br.borrow_date DESC;

    ALTER TABLE borrow
    MODIFY borrow_return_date TIMESTAMP NULL DEFAULT NULL;

    UPDATE borrow
    SET borrow_return_date = NULL
    WHERE borrow_return_date = '2026-08-25 08:18:28';

    ALTER TABLE borrow
    MODIFY borrow_return_date TIMESTAMP NULL DEFAULT NULL;


UPDATE borrow
SET borrow_return_date = CURRENT_TIMESTAMP

WHERE borrow_id = 1 AND borrow_return_date IS NULL;

SELECT