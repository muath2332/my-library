<?php
// Include the config.php file
require 'config.php';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all books from the 'books' table
$sql = "SELECT author, book_title, book_number, publication_date FROM books";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الكتب</title>
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

        .container {
            width: 80%;
            max-width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fdfdfd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>قائمة الكتب</h1>
        <a href="index.php" style=" display: inline-block; background-color: #00b894; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-family: 'Arial', sans-serif; direction: rtl;">الصفحة الرئيسية</a>
        <table>
            <thead>
                <tr>
                    <th>المؤلف</th>
                    <th>الكتاب</th>
                    <th>رقم الكتاب</th>
                    <th>تاريخ النشر</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['author']}</td>
                                <td>{$row['book_title']}</td>
                                <td>{$row['book_number']}</td>
                                <td>{$row['publication_date']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>لا يوجد كتب في القائمة</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>