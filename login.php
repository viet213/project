<?php
include('connect.php');
session_start();

// Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng đến trang select.php
if (isset($_SESSION['username'])) {
    header('Location: select.php');
    exit();
}

// Xử lý đăng nhập khi người dùng nhấn nút "Đăng nhập"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form đăng nhập
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Sử dụng prepared statements để tránh SQL injection
    $stmt = $conn->prepare("SELECT Username, Password, Role FROM tbl_users WHERE username = ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Kiểm tra xem có dữ liệu trả về không
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbUsername, $dbPassword, $dbRole);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if ($password==$dbPassword) {
            // Lưu thông tin người dùng vào phiên
            $_SESSION['username'] = $dbUsername;
            $_SESSION['role'] = $dbRole;

            // Chuyển hướng đến trang index.php sau khi đăng nhập thành công
            header('Location: select.php');
            exit();
        } else {
            $error_message = "Mật khẩu không đúng. Vui lòng thử lại.";
        }
    } else {
        $error_message = "Tên đăng nhập không tồn tại. Vui lòng thử lại.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <form method="post" action="login.php">
        <h1>Đăng nhập</h1>

        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
