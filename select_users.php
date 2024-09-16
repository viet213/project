<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản người dùng</title>
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
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 20px;
            
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            width: 10%; /* Đặt độ rộng cố định cho từng cột, có thể điều chỉnh giá trị này */
        }

        tr:hover {
            background-color: #f5f5f5;
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

    </style>
</head>
<body>
    <nav>
		<ul>
			<li><a href="select.php">trở về</a></li>
		</ul>
	</nav>
    <h1 style="text-align:center;">DANH SACH TÀI KHOẢN NGƯỜI DÙNG</h1>
    <?php
        include("connect.php");

        $sql='SELECT * FROM tbl_users';

        $result=mysqli_query($conn,$sql);

        if($result)
        {
            echo"<table border='1' width='100%'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>sua</th>
                <th>xoa</th>
            </tr>";

            while($rows=mysqli_fetch_assoc($result))
            {
                echo"<tr>
                    <td>",$rows['UserID'],"</td>
                    <td>",$rows['Username'],"</td>
                    <td>",$rows['Password'],"</td>
                    <td>",$rows['Role'],"</td>
                    <td><a href='update_users.php?id=",$rows['UserID'],"'>sua</a></td>
                    <td><a href='delete_users.php?id=",$rows['UserID'],"'>xoa</a></td>
                </tr>";
            }
            echo "</table>";
        }
        mysqli_close($conn);
    ?>
</body>
</html>