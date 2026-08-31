<?php
require_once 'config/config.php';
require_once 'includes/activity_logger.php';

$students = $pdo->query("
    SELECT student_id, student_first_name, student_last_name
    FROM students
")->fetchALL(PDO::FETCH_ASSOC);


$books = $pdo->query("
    SELECT book_id, book_title
    FROM books
")->fetchALL(PDO::FETCH_ASSOC);



?>