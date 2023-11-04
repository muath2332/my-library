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

$isSearch = false; // Flag to check if the search button has been pressed

// If there's a search query, modify the SQL to filter results
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_query']) && !empty($_POST['search_query'])) {
    $isSearch = true; // Set the flag to true if the form was submitted
    $search_query = $conn->real_escape_string($_POST['search_query']);
    $sql .= " WHERE author LIKE '%$search_query%' OR book_title LIKE '%$search_query%' OR book_number LIKE '%$search_query%'";
    $result = $conn->query($sql);
}
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
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 32px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #00b894;
            padding-bottom: 10px;
        }

        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: #00b894;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #00897b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #00b894;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td {
            color: #555;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>قائمة الكتب</h1>

    <!-- Search Bar -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="search_query" placeholder="بحث...">
        <input type="submit" value="بحث">
    </form>

    <?php if ($isSearch): ?>
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
            if ($result && $result->num_rows > 0) {
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
                echo "<tr><td colspan='4'>لا توجد نتائج</td></tr>"; // "No results found"
            }
            ?>
        </tbody>
    </table>
    <?php endif; ?>

</div>

<?php
$conn->close();
?>
</body>
</html>