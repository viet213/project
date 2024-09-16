<?php
    include('connect.php');
    $manv=$_GET['id'];
    $sql = "DELETE FROM tbl_nhanvien WHERE MaNV = '$manv'";
    $result=mysqli_query($conn,$sql);
    if($result)
		{
			header('location: select.php');
		}
?>

