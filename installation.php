<?php
// Include the config.php file
require 'config.php';

$message = "";
$installationStarted = false;

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $installationStarted = true;

    // Check if table 'books' already exists
    $checkTable = "SHOW TABLES LIKE 'books'";
    $checkResult = $conn->query($checkTable);

    if ($checkResult->num_rows == 0) {
        // Table doesn't exist, create it
        $sql = "CREATE TABLE books (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            author VARCHAR(255) NOT NULL,
            book_title VARCHAR(255) NOT NULL,
            book_number VARCHAR(50) NOT NULL,
            publication_date DATE NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            $message = "تم تنصيب المكتبة على قاعدة البيانات, شكرا  لكم على استخدامكم لمكتبة معاذ!";
        } else {
            $message = "Error creating table: " . $conn->error;
        }
    } else {
        $message = "Table 'books' already exists!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            direction: rtl; /* Right-to-left for Arabic */
            background-color: #f4f4f4; /* Background color */
        }

        h1 {
            font-size: 24px;
            color: green;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: green;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 5px;
        }

        button:hover {
            background-color: #005700;
        }
    </style>
</head>
<body>
    <h1>أهلا بكم في مكتبة معاذ</h1>

    <?php if (!$installationStarted): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit">نصب البرنامج الأن</button>
        </form>
    <?php else: ?>
        <h1><?php echo $message; ?></h1>
    <?php endif; ?>
</body>
</html>