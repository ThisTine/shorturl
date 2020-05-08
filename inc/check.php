<?php
include 'dbh.php';
$path = $_POST['path'];
if(empty($path)){
    echo 3;
    exit();
}
if(isset($_POST['sts'])){
    $sql = "SELECT path FROM link WHERE path='$path';";
    $que = $conn->query($sql);
    $num = mysqli_num_rows($que);
    if($num != 0){
        echo 0;  
    } else{
        echo 1;
    }
}