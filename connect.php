<?php
    $host = 'localhost';
    $use='root';
    $pass='';
    $data ='quanlyNS';
    
    $conn= mysqli_connect($host,$use,$pass,$data);
    if(!$conn)
    {
        echo "ket noi khong thanh cong";
    }
    mysqli_set_charset($conn,'utf8');
?>