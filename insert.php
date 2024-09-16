<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thêm thông tin nhan su</title>

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
    <h1>THÊM THÔNG TIN NHÂN SỰ</h1>
    <?php
    include('connect.php');
    ?>
	<form action="insert.php" method="post" enctype="multipart/form-data">
		MÃ NHÂN VIÊN: <input type="text" name="MaNV"><br>
		HỌ TÊN:<input type="text" name="HoTen"><br>
		GIỚI TÍNH: 
			<select name="GioiTinh">
				<option value="Nam">Nam</option>
				<option value="Nữ">Nữ</option>
				<option value="Khác">Khác</option>
			</select><br>
        NGÀY SINH:<input type="date" name="NgaySinh"><br>
		ĐỊA CHỈ: <input type="text" name="DiaChi"><br>
        SỐ ĐIỆN THOẠI:<input type="text" name="sdt"><br>
        EMAIL:<input type="email" name="email"><br>
        TÊN PHÒNG BAN:
            <select name="MaPB">
                <?php
                // Truy vấn để lấy tất cả thông tin từ bảng tbl_phongban
                $query_phongban = "SELECT MaPB, TenPB FROM tbl_phongban";
                $result_phongban = mysqli_query($conn, $query_phongban);

                while ($row_phongban = mysqli_fetch_assoc($result_phongban)) {
                    echo "<option value='{$row_phongban['MaPB']}'>{$row_phongban['TenPB']}</option>";
                }
                ?>
            </select><br>
        ẢNH:<input type="file" name="anh"><br>
		<input type="submit" name="btnThem" value="Thêm thông tin">
	</form>
<?php

	if (isset($_POST['btnThem']))
	{
		$manv = $_POST['MaNV'];
		$hoten = $_POST['HoTen'];
        $gioitinh = $_POST['GioiTinh'];
        $ngaysinh = $_POST['NgaySinh'];
		$diachi = $_POST['DiaChi'];
		$sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $mapb = $_POST['MaPB'];
        $anh = $_FILES['anh']['name'];
        $target = "C:\\xampp\\htdocs\\backend\\img\\" . basename($anh);

        // Thêm kiểm tra loại file và chỉ chấp nhận một số loại ảnh phổ biến
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            echo "Chỉ chấp nhận các file có định dạng JPG, JPEG, PNG hoặc GIF.";
            exit; // Dừng xử lý nếu định dạng không hợp lệ
        }

        if (move_uploaded_file($_FILES['anh']['tmp_name'], $target)) {
            // Tệp đã được di chuyển thành công, tiếp tục xử lý
            $sql_nhanvien = "INSERT INTO tbl_nhanvien (MaNV, HoTen, GioiTinh, NgaySinh, DiaChi, sdt, email, MaPB, anh) 
                VALUES ('$manv', '$hoten', '$gioitinh', '$ngaysinh', '$diachi', '$sdt', '$email','$mapb', '$anh')";

            $result_nhanvien = mysqli_query($conn, $sql_nhanvien);

            if ($result_nhanvien) {
                echo "Thêm thông tin thành công";
                header('location: select.php');
            } else {
                echo "Thêm thông tin thất bại";
            }
        } else {
            echo "Lỗi khi di chuyển tệp.";
        }
    }
    mysqli_close($conn);

?>
</body>
</html>
