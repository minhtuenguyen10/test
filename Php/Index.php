<?php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Ví dụ mô hình MVC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        nav {
            text-align: center;
            margin-top: 20px;
        }
        nav a {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px;
            font-size: 18px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #0056b3;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ví dụ mô hình MVC</h2>
        <nav>
            <?php
            echo '<a href="../Php/Controller/C_Student.php">Xem thông tin sinh viên</a>';
            echo '<a href="../Php/View/StudentAdd.html">Thêm sinh viên mới</a>';
            echo '<a href="../Php/Controller/C_Student.php?action=update">Cập nhật thông tin</a>';
            echo '<a href="../Php/Controller/C_Student.php?action=delete">Xóa thông tin sinh viên</a>';
            echo '<a href="../Php/View/StudentSearch.html">Tìm kiếm thông tin</a>';
            ?>
        </nav>
    </div>
</body>
</html>
<?php
?>
