<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thông tin nhan su</title>
	<style>
		
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ADD8E6;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            background-color: #FAEBD7; 
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        a:hover {
            color: green; /* Thay đổi màu của liên kết khi di chuột qua */
            font-weight: bold; /* Làm đậm liên kết */
            text-decoration: underline; /* Gạch chân liên kết */
        }

        a {
            display: inline-block;
            margin: 10px auto;
            padding: 10px 20px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            text-align: center;
        }

        nav {
            margin: 10px 0;
        }

        ul {
            list-style-type: none; /* Xóa dấu chấm */
            border: 1px solid black; /* Tạo đường viền */
            padding: 0;
        }

        li {
            display: inline-block; /* Đưa các mục menu nằm ngang */
            margin: 0 10px; /* Tạo khoảng cách giữa các mục menu */
        }

	</style>
</head>
<body>
<nav>
		<ul>
			<li><a href="insert.php">Thêm</a></li>
			<li><a href="search.php">Tìm</a></li>
		</ul>
	</nav>
	<h1>Thông tin nhan su</h1>
<?php
	include('connect.php');

	$sql= 'SELECT nv.MaNV, nv.HoTen, nv.GioiTinh, nv.NgaySinh, nv.DiaChi, nv.sdt, nv.email, pb.TenPB, nv.anh
        FROM tbl_nhanvien AS nv
        JOIN tbl_phongban AS pb ON nv.MaPB = pb.MaPB';
        $result= mysqli_query($conn, $sql);
        if ($result)
	    {
            echo"<table border='1' width='100%'>
            <tr>
                <th>MA NHAN VIEN</th>
                <th>TEN NHAN VIEN</th>
                <th>GIOI TINH</th>
                <th>NGAY SINH</th>
                <th>DIA CHI</th>
                <th>SO DIEN THOAI</th>
                <th>EMAIL</th>
                <th>PHONG BAN</th>
                <th>ANH</th>
                <th>CHINH SUA</th>
                <th>XOA</th>
            </tr>";

            while($rows = mysqli_fetch_assoc($result))
            {
                echo"<tr>
                    <td>",$rows['MaNV'],"</td>
                    <td>",$rows['HoTen'],"</td>
                    <td>",$rows['GioiTinh'],"</td>
                    <td>",$rows['NgaySinh'],"</td>
                    <td>",$rows['DiaChi'],"</td>
                    <td>",$rows['sdt'],"</td>
                    <td>",$rows['email'],"</td>
                    <td>",$rows['TenPB'],"</td>
                    <td><img src='".$rows['anh']."' alt='nhan vien image' width='100%' ></td>
                    <td><a href='update.php?id=",$rows['MaNV'],"'>sua</a></td>
                    <td><a href='delete.php?id=",$rows['MaNV'],"'>xoa</a></td>
                </tr>";
            }
            echo "</table>";
	    }	
	mysqli_close($conn);
    ?>
</body>
</html>