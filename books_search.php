<?php
// Include the config.php file
require 'config.php';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the SQL query
$sql = "SELECT author, book_title, book_number, publication_date FROM books";

// If there's a search query, modify the SQL to filter results
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = $conn->real_escape_string($_POST['author']);
    $book_title = $conn->real_escape_string($_POST['book_title']);
    $book_number = $conn->real_escape_string($_POST['book_number']);
    $publication_date = $conn->real_escape_string($_POST['publication_date']);

    $whereClauses = []; // An array to hold all our WHERE clauses

    if ($author) $whereClauses[] = "author LIKE '%$author%'";
    if ($book_title) $whereClauses[] = "book_title LIKE '%$book_title%'";
    if ($book_number) $whereClauses[] = "book_number LIKE '%$book_number%'";
    if ($publication_date) $whereClauses[] = "publication_date = '$publication_date'";

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }
}

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

        input[type="text"], input[type="date"] {
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #00b894;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>قائمة الكتب</h1>
        <a href="index.php" style="margin-bottom:10px; display: inline-block; background-color: #00b894; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-family: 'Arial', sans-serif; direction: rtl;">الصفحة الرئيسية</a>
        <!-- Advanced Search Form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            المؤلف: <input type="text" name="author" placeholder="المؤلف">
            الكتاب: <input type="text" name="book_title" placeholder="الكتاب">
            رقم الكتاب: <input type="text" name="book_number" placeholder="رقم الكتاب">
            تاريخ النشر: <input type="date" name="publication_date">
            <input type="submit" value="بحث">
        </form>

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