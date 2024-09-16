<?php
    include('connect.php');
    $id=$_GET['id'];
    $sql = "DELETE FROM tbl_users WHERE UserID = '$id'";
    $result=mysqli_query($conn,$sql);
    if($result)
		{
			header('location: select_users.php');
		}
?>

