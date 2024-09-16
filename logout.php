<?php
session_start();

// Hủy toàn bộ phiên làm việc
session_unset();
session_destroy();

// Chuyển hướng đến trang đăng nhập
header('Location: login.php');
exit();
?>
