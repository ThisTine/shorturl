<?php
if(isset($_POST['check'])){
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    if(empty($uname) || empty($email) || empty($pwd)){
        echo 'error';
    }
    else{
        include 'dbh.php';
        $sql = "SELECT uname FROM `login` WHERE uname = '$uname'";
        $sql2 = "SELECT email FROM `login` WHERE email = '$email'";
        $repuname = $conn -> query($sql);
        $repemail = $conn -> query($sql2);
        if(mysqli_fetch_assoc($repuname)){
            echo 'This username does exist please choose the new usename';
        }else if(mysqli_fetch_assoc($repemail)){
            echo 'This email does exist please choose the new email';
        }else{
            $pwdhash = password_hash("$pwd", PASSWORD_DEFAULT);
            $sql = "INSERT INTO `login`(`uname`, `unick`, `email`, `pwd`, `role`) VALUES ('$uname','$uname','$email','$pwdhash','2')";
            $conn->query($sql);
            echo 'success';
        }
    }
}else{
    header("../");
}