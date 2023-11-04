<?php

// Include the config.php file
require 'config.php';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST
$author = $conn->real_escape_string($_POST['author']);
$book_title = $conn->real_escape_string($_POST['book_title']);
$book_number = $conn->real_escape_string($_POST['book_number']);
$publication_date = $conn->real_escape_string($_POST['publication_date']);

// Insert data into the 'books' table
$sql = "INSERT INTO books (author, book_title, book_number, publication_date)
VALUES ('$author', '$book_title', '$book_number', '$publication_date')";

$message = "Error: " . $sql . "<br>" . $conn->error;

if ($conn->query($sql) === TRUE) {
    $message = "New book added successfully!";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتيجة التسليم</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            direction: rtl; /* Right-to-left for Arabic */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .message-container {
            width: 80%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #00b894;
            padding-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: green;
            margin-top: 20px;
        }
    </style>
    <?php if ($message == "New book added successfully!"): ?>
        <meta http-equiv="refresh" content="3;url=index.php">
    <?php endif; ?>
</head>
<body>
    <div class="message-container">
        <h1>نتيجة التسليم</h1>
        <p><?php echo $message == "New book added successfully!" ? "تم إضافة الكتاب بنجاح, شكرا لك سيتم تحويلك للصفحة الرئيسية خلال 3 ثواني." : $message; ?></p>
    </div>
</body>
</html>