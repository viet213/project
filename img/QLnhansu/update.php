<?php
	include('connect.php');
	$manv = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sửa thông tin nhan vien</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            width: 80%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        }

        select {
            background-color: #fff;
            color: #333;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav>
		<ul>
			<li><a href="select.php">trở về</a></li>
		</ul>
	</nav>
    <h1>SỬA THÔNG TIN NHÂN SỰ</h1>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
	include('connect.php');
	$manv = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sửa thông tin nhan vien</title>
</head>
<body>
<?php
	 $sql= "SELECT nv.MaNV, nv.HoTen, nv.GioiTinh, nv.NgaySinh, nv.DiaChi, nv.sdt, nv.email, pb.TenPB, nv.anh
     FROM tbl_nhanvien AS nv
     JOIN tbl_phongban AS pb ON nv.MaPB = pb.MaPB WHERE MaNV='$manv'";
    
    $result = mysqli_query($conn, $sql);

	$rows = mysqli_fetch_row($result);
?>
<form action='update.php?id=<?php echo $manv;?>' method="post">
    MÃ NHÂN VIÊN:  <input type="text" name="MaNV" readonly="true" value ='<?php echo $rows[0]; ?>'><br>
	HỌ TÊN:<input type="text" name="HoTen" value='<?php echo $rows[1]; ?>'><br>
    GIỚI TÍNH: 
        <select name="GioiTinh">
            <option value="Nam" <?php if($rows[2] == 'Nam') echo 'selected'; ?>>Nam</option>
            <option value="Nữ" <?php if($rows[2] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            <option value="Khác" <?php if($rows[2] == 'Khác') echo 'selected'; ?>>Khác</option>
	    </select><br>
    NGÀY SINH:<input type="date" name="NgaySinh" value='<?php echo $rows[3]; ?>'><br>
    ĐỊA CHỈ: <input type="text" name="DiaChi" value='<?php echo $rows[4]; ?>'><br>
    SỐ ĐIỆN THOẠI:<input type="text" name="sdt" value='<?php echo $rows[5]; ?>'><br>
    EMAIL: <input type="email" name="email" value='<?php echo $rows[6]; ?>'><br>
    TÊN PHÒNG BAN:
        <select name="TenPB">
            <?php
            // Truy vấn để lấy tên tất cả các phòng ban
            $query_phongban = "SELECT TenPB FROM tbl_phongban";
            $result_phongban = mysqli_query($conn, $query_phongban);

            while ($row_phongban = mysqli_fetch_assoc($result_phongban)) {
                $selected = ($rows[7] == $row_phongban['TenPB']) ? 'selected' : '';
                echo "<option value='{$row_phongban['TenPB']}' $selected>{$row_phongban['TenPB']}</option>";
            }
            ?>
        </select><br>

    ẢNH:<input type="text" name="anh" value='<?php echo $rows[8]; ?>'><br>
	<input type="submit" name="btnSua" value="Lưu thông tin">
</form>
<?php

    
	
	if (isset($_POST['btnSua']))
	{
		$manv = $_POST['MaNV'];
		$hoten = $_POST['HoTen'];
        $gioitinh = $_POST['GioiTinh'];
        $ngaysinh = $_POST['NgaySinh'];
		$diachi = $_POST['DiaChi'];
		$sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $tenpb = $_POST['TenPB'];
        $anh = $_POST['anh'];
    
        
        $sql_mapb = "SELECT MaPB FROM tbl_phongban WHERE TenPB='$tenpb'";
        $result_mapb = mysqli_query($conn, $sql_mapb);
        $row_pb = mysqli_fetch_row($result_mapb);
        $mapb = $row_pb[0];

        // Update tbl_phongban
        $sql_phongban = "UPDATE tbl_phongban SET TenPB='$tenpb' WHERE MaPB='$mapb'";

        // Update tbl_hoso
        $sql_nhanvien = "UPDATE tbl_nhanvien SET MaNV='$manv', HoTen='$hoten', GioiTinh='$gioitinh', NgaySinh='$ngaysinh', DiaChi='$diachi', sdt='$sdt', 
        email='$email', anh='$anh', MaPB='$mapb' WHERE MaNV='$manv'";

        //Execute the queries
        $result_phongban = mysqli_query($conn, $sql_phongban);
        $result_nhanvien = mysqli_query($conn, $sql_nhanvien);

        if ($result_nhanvien && $result_phongban) 
        {
            header('location: select.php');
            exit();
        } 
        else 
        {
            echo "Cập nhật thông tin thất bại";
        }
        
    }
    mysqli_close($conn);

	
?>
</body>
</html>