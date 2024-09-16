<?php
include('connect.php');
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = $_POST['role']; // Lấy giá trị role từ form

    // Sử dụng prepared statements để tránh SQL injection
    $stmt = $conn->prepare("INSERT INTO tbl_users (Username, Password, Role) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $username, $password, $role);
    
    if($stmt->execute()){
        $success_message = "Đăng ký thành công!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            color: #333;
        }

        nav {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            background-color: #333;
            overflow: hidden;
        }

        nav li {
            float: left;
        }

        nav a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: #007BFF;
            text-align: center;
            margin-bottom: 15px;
        }
        
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="login.php">Trở về</a></li>
        </ul>
    </nav>
    <form method="post" action="register.php">
        <h1>Đăng ký</h1>
        <?php if (!empty($success_message)) { ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php } ?>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Loại tài khoản:</label>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
