<?php
session_start();
include('connect.php');
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Lấy thông tin người dùng từ phiên
$username = $_SESSION['username'];
$role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin nhan su</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0e0e0; /* Đổi màu nền */
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 90%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 20px;
            
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        nav ul {
            list-style-type: none;
            padding: 10px;
            background-color: #333;
            overflow: hidden;
            margin: 10px 0;
           
        }

        nav li {
            float: left;
            /* text-align: center; */
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

        img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        td img {
            width: 600px; /* Đổi giá trị này để làm cho cột ảnh rộng hơn */
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <?php
            // Hiển thị các liên kết tương ứng với quyền của người dùng
            if ($role == 'admin') {
                echo '<li><a href="insert.php">Thêm nhân viên</a></li>
                <li><a href="register.php">Tạo người dùng</a></li>
                <li><a href="select_users.php">Danh sách người dùng</a></li>';
            }
            echo'
            <li><a href="search.php">Tìm kiếm</a></li>
            <li><a href="logout.php">Đăng xuất</a></li>';
            ?>
        </ul>
    </nav>
    <h1>Thông tin nhan su</h1>

    <?php
    // Hiển thị thông tin nhân sự

    $sql = 'SELECT nv.MaNV, nv.HoTen, nv.GioiTinh, nv.NgaySinh, nv.DiaChi, nv.sdt, nv.email, pb.TenPB, nv.anh
            FROM tbl_nhanvien AS nv
            JOIN tbl_phongban AS pb ON nv.MaPB = pb.MaPB';
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<table border='1' >
            <tr>
                <th>MA NHAN VIEN</th>
                <th>TEN NHAN VIEN</th>
                <th>GIOI TINH</th>
                <th>NGAY SINH</th>
                <th>DIA CHI</th>
                <th>SO DIEN THOAI</th>
                <th>EMAIL</th>
                <th>PHONG BAN</th>
                <th>ANH</th>";

        if ($role == 'admin') {
            echo "<th>CHINH SUA</th>
                  <th>XOA</th>";
        }

        echo "</tr>";

        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>", $rows['MaNV'], "</td>
                    <td>", $rows['HoTen'], "</td>
                    <td>", $rows['GioiTinh'], "</td>
                    <td>", $rows['NgaySinh'], "</td>
                    <td>", $rows['DiaChi'], "</td>
                    <td>", $rows['sdt'], "</td>
                    <td>", $rows['email'], "</td>
                    <td>", $rows['TenPB'], "</td>
                    <td><img src='img/" . $rows['anh'] . "' alt='nhan vien image' ></td>";

            if ($role == 'admin') {
                echo "<td><a href='update.php?id=", $rows['MaNV'], "'>SỬA</a></td>
                      <td><a href='delete.php?id=", $rows['MaNV'], "'>XÓA</a></td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    }
    mysqli_close($conn);
    ?>
</body>
</html>
