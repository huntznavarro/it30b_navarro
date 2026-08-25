SELECT  br.borrow_id,s.student_id,
    CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
    s.student_course,b.book_title,b.book_author,b.book_category,
    br.borrow_date FROM borrow br
    JOIN students s ON br.student_id = s.student_id
    JOIN books b ON br.book_id = b.book_id
    ORDER BY br.borrow_date DESC;