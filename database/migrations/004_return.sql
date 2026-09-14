
SELECT
    br.borrow_id;

    --student full name

    CONCAT(
        s.student_first_name,
        '',
        s.student_last_name,
        '',
    
    )AS studen_name,

    -- books

    b.book_title
    b.book_author,
    b.book_category,

    --borrow date 
    br.borrow_date
    FROM borrow br
    INNER JOIN students s
        ON br.student_id = b.student_id
    INNER JOIN books b
        ON br.book_id = b.book_id
WHERE br.borrow_return_date IS NULL

ORDER BY br.borrow _date DESC;

-- Return a book

UPDATE borrow
SET borrow_return_date = CURRENT_TIMESTAMP
WHERE borrow_id = 
  AND borrow_return_date IS NOT NULL;


  -- View returned books
  SELECT
    br.borrow_id,

    CONCAT(
        s.student_first_name,
        ' ',
        s.student_last_name
    ) AS student_name,

    b.book_title,
    b.book_author,
    b.book_category,

    br.borrow_date,
    br.borrow_return_date

FROM borrow br

INNER JOIN students s
    ON br.student_id = s.student_id

INNER JOIN books b
    ON br.book_id = b.book_id

WHERE br.borrow_return_date IS NOT NULL

ORDER BY br.borrow_date DESC;