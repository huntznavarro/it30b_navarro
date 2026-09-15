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

function getBorrowedBooks($pdo, $sortColumn = 'due_date', $sortDirection = 'ASC'){
    $allowedColumns = [
        'student' => 's.student_last_name',
        'book' => 'bk.book_title',
        'borrow_date' => 'b.borrow_date',
        'due_date' => 'b.due_date',
        'status' => 'b.status'
    ];

    $column = $allowedColumns[$sortColumn] ?? 'b.due_date';
    $direction = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';

    $sql = "
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
        ORDER BY $column $direction
    ";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

    $sortColumn = $_GET['sort'] ?? 'due_date';
    $sortDirection = $_GET['dir'] ?? 'ASC';
    $borrowedBooks = getBorrowedBooks($pdo, $sortColumn, $sortDirection);

    function buildSortLink($column, $currentSort, $currentDir, $label){
        $newDir = ($column === $currentSort && $currentDir === 'ASC') ? 'DESC' : 'ASC';
        $arrow = '';
        if ($column === $currentSort) {
            $arrow = $currentDir === 'ASC' ? ' ▲' : ' ▼';
        }
        return '<a href="?sort=' . $column . '&dir=' . $newDir . '" style="color:inherit;text-decoration:none;">' . $label . $arrow . '</a>';
    }

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
     if ($action === 'Return Book') {

        $borrow_id = $_POST['borrow_id'];

        $stmt = $pdo->prepare("
            UPDATE borrow
            SET borrow_return_date = CURDATE(), status = 'returned'
            WHERE borrow_id = ? AND borrow_return_date IS NULL
        ");

        $success = $stmt->execute([$borrow_id]);

        if ($success) {
            logActivity($pdo, $user_id, $user_email, 'Return Book', 'success');
            $message = 'Book returned successfully and activity logged.';
            $messageType = 'success';
            $borrowedBooks = getBorrowedBooks($pdo);
        } else {
            $message = 'Something went wrong while returning the book.';
            $messageType = 'error';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Library Book Borrowing System</title>

<style>
    * { box-sizing: border-box; }

    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 40px 20px;
        color: #2d2d2d;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 30px;
        color: #1a2b4c;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    }

    .card h2 {
        font-size: 18px;
        margin-top: 0;
        margin-bottom: 18px;
        color: #1a2b4c;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }

    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d0d5db;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 18px;
        background: #fafbfc;
    }

    button {
        background: #2f6fed;
        color: #fff;
        border: none;
        padding: 11px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    button:hover {
        background: #2558c2;
    }

    button.return-btn {
        background: #d9822b;
    }

    button.return-btn:hover {
        background: #b8681c;
    }

    .message {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .message.success {
        background: #e6f7ec;
        color: #1e7a3d;
        border: 1px solid #b6e6c5;
    }

    .message.error {
        background: #fdeaea;
        color: #b32020;
        border: 1px solid #f3b7b7;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        text-align: left;
        padding: 10px 12px;
        border-bottom: 1px solid #eee;
    }

    th {
        color: #888;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge.borrowed {
        background: #e8f0fe;
        color: #2f6fed;
    }

    .badge.overdue {
        background: #fdeaea;
        color: #d92c2c;
    }

    .empty-state {
        color: #999;
        font-style: italic;
        padding: 10px 0;
    }
</style>

</head>
<body>

<div class="container">

    <h1>📚 Library Book Borrowing System</h1>

    <?php if ($message): ?>
        <div class="message <?= $messageType ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Borrow a Book</h2>
        <form method="post">
            <label>Student</label>
            <select name="student_id" required>
                <option value="">Select Student</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student['student_id'] ?>">
                        <?= htmlspecialchars($student['student_first_name'] . ' ' . $student['student_last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Book</label>
            <select name="book_id" required>
                <option value="">Select Book</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book['book_id'] ?>">
                        <?= htmlspecialchars($book['book_title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="action" value="Borrow Book">Borrow Book</button>
        </form>
    </div>

    <div class="card">
        <h2>Return a Book</h2>
        <?php if (count($borrowedBooks) > 0): ?>
            <form method="post">
                <label>Borrowed Book</label>
                <select name="borrow_id" required>
                    <option value="">Select Borrowed Book</option>
                    <?php foreach ($borrowedBooks as $b): ?>
                        <option value="<?= $b['borrow_id'] ?>">
                            <?= htmlspecialchars($b['student_first_name'] . ' ' . $b['student_last_name'] . ' — ' . $b['book_title'] . ' (Due: ' . $b['due_date'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="action" value="Return Book" class="return-btn">Return Book</button>
            </form>
        <?php else: ?>
            <p class="empty-state">No books are currently borrowed.</p>
        <?php endif; ?>
    </div>

    <div class="card">
        <h2>Currently Borrowed Books</h2>
        <?php if (count($borrowedBooks) > 0): ?>
            <table>
                <tr>
                    <th><?= buildSortLink('student', $sortColumn, $sortDirection, 'Student') ?></th>
                    <th><?= buildSortLink('book', $sortColumn, $sortDirection, 'Book') ?></th>
                    <th><?= buildSortLink('borrow_date', $sortColumn, $sortDirection, 'Borrowed On') ?></th>
                    <th><?= buildSortLink('due_date', $sortColumn, $sortDirection, 'Due Date') ?></th>
                    <th><?= buildSortLink('status', $sortColumn, $sortDirection, 'Status') ?></th>
                </tr>
                <?php foreach ($borrowedBooks as $b):
                    $isOverdue = strtotime($b['due_date']) < strtotime(date('Y-m-d'));
                    $statusLabel = $isOverdue ? 'Overdue' : 'Borrowed';
                    $statusClass = $isOverdue ? 'overdue' : 'borrowed';
                ?>
                    <tr>
                        <td><?= htmlspecialchars($b['student_first_name'] . ' ' . $b['student_last_name']) ?></td>
                        <td><?= htmlspecialchars($b['book_title']) ?></td>
                        <td><?= htmlspecialchars($b['borrow_date']) ?></td>
                        <td><?= htmlspecialchars($b['due_date']) ?></td>
                        <td><span class="badge <?= $statusClass ?>"><?= $statusLabel ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="empty-state">Nothing to show.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>