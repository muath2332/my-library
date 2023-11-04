<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Submission</title>
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

        .form-container {
            width: 80%;
            max-width: 400px;
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
            flex-direction: column;
            gap: 10px;
        }

        label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }

        input[type="text"], input[type="date"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
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
            align-self: center;
        }

        input[type="submit"]:hover {
            background-color: #00897b;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>إضافة كتاب</h1>
        <form action="submit_book.php" method="post">
            <label>
                المؤلف:
                <input type="text" name="author" required>
            </label>
            <label>
                الكتاب:
                <input type="text" name="book_title" required>
            </label>
            <label>
                رقم الكتاب:
                <input type="number" name="book_number" required>
            </label>
            <label>
                تاريخ النشر:
                <input type="date" name="publication_date" required>
            </label>
            <input type="submit" value="Submit">
              <a href="index.php" style=" display: block; background-color: #00b894; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-family: 'Arial', sans-serif; direction: rtl; text-align: center;">الصفحة الرئيسية</a>
        </form> 
     
    </div>
</body>
</html>