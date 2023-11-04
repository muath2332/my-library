<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة معاذ</title>
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
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #00b894;
            padding-bottom: 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #fff;
            background-color: #00b894;
        }

        .btn:hover {
            background-color: #00856f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>أهلا بكم في مكتبة معاذ</h1>
        <a href="books_list.php" class="btn">قائمة الكتب</a>
        <a href="books_search.php" class="btn">البحث عن كتاب</a>
    </div>
</body>
</html>
