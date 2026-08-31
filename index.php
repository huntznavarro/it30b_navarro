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

function getBorrowedBooks($pdo){
    return $pdo->query("
        SELECT
             b.borrow_id,
            s.student_first_name,
            s.student_last_name,
            bk.book_title,
            b.borrow_date,
            b.due_date,
            b.status

     FROM borrow b
        JOIN students s ON b.student_id = s.student_id
        JOIN books bk ON b.book_id = bk.book_id
        WHERE b.borrow_return_date IS NULL
        ORDER BY b.due_date ASC
    ")->fetchAll(PDO::FETCH_ASSOC);

  
}
    $borrowedBooks = getBorrowedBooks($pdo);

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    $user_id = 'root';
    $user_email = 'root';


    if ($action === 'Borrow Book') {

        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];

        $stmt = $pdo->prepare("
            INSERT INTO borrow (student_id, book_id, borrow_date)
            VALUES (?, ?, NOW())
        ");

        $success = $stmt->execute([$student_id, $book_id]);

        if ($success) {
            logActivity($pdo, $user_id, $user_email, 'Borrow Book', 'success');
            $message = 'Book borrowed successfully and activity logged.';
            $messageType = 'success';
            $borrowedBooks = getBorrowedBooks($pdo);
        } else {
            $message = 'Something went wrong while borrowing the book.';
            $messageType = 'error';
        }
    }


?>