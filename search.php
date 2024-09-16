<?php
    include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tìm kiếm thông tin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
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
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            margin-top: 20px;
        }

        form input[type="text"],
        form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
            box-sizing: border-box;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 70%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<nav>
		<ul>
			<li><a href="select.php">trở về</a></li>
		</ul>
	</nav>
    <div align="center">
            <form action="search.php" method="get">
                Search: <input type="text" name="search">
                <input type="submit" name="btnTimkiem" value="Search">
            </form>
    </div>

    <?php
        if (isset($_GET['btnTimkiem']))
        {
            $search = $_GET['search'];

            // $sql = "Select * from tbl_khachhang where tenkh like '%$search%'";
            $sql = "SELECT * FROM tbl_nhanvien WHERE CONCAT(HoTen, ' ', DiaChi, ' ', sdt, ' ', MaNV, ' ', GioiTinh) LIKE '%$search%'";

            
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num > 0 && $search != "") 
                {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num ket qua tra ve voi tu khoa <b>$search</b>";
 
                    // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
                    while ($row = mysqli_fetch_array($result)) 
                    {
                        echo "<tr>
                            <td>",$row['MaNV'],"</td>
                             <td>",$row['HoTen'],"</td>
                             <td>",$row['GioiTinh'],"</td>
                             <td>",$row['NgaySinh'],"</td>
                             <td>",$row['DiaChi'],"</td>
                             <td>",$row['sdt'],"</td>
                             <td>",$row['email'],"</td>
                        </tr>";
                    }
                    echo '</table>';
                } 
                else {
                    exit;
                }
        }
    ?>
</body>
</html>
