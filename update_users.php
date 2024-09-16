<?php
    include('connect.php');
    $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chinh sua tai khoan nguoi dung</title>
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
        select {
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
<?php
    $sql="SELECT * FROM tbl_users WHERE UserID='$id'";
    $result=mysqli_query($conn,$sql);   
    $rows=mysqli_fetch_row($result);

?>

    <form action="update_users.php?id=<?php echo $id?>" method="post">
            UserID: <input type="text" name="UserID" readonly="true" value="<?php echo $rows[0] ?>"><br>
            Username:<input type="text" name="Username" value="<?php echo $rows[1] ?>"><br>
            Password:<input type="text" name="Password" value="<?php echo $rows[2] ?>"><br>
            Vai tro:
            <select name="Role">
                <option value="user" <?php if($rows[3] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($rows[3] == 'admin') echo 'selected'; ?>>Admin</option>
	        </select><br>
            <input type="submit" value="luu thong tin" name ="btnThem">
</form>
<?php
    if(isset($_POST['btnThem']))
    {
        $id=$_POST['UserID'];
        $username=$_POST['Username'];
        $password=$_POST['Password'];
        $role=$_POST['Role'];

        $sql="UPDATE tbl_users SET UserID='$id',Username='$username', Password='$password', Role='$role' WHERE UserID='$id'";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            header("location:select_users.php");
        }
    }
?>
</body>
</html>