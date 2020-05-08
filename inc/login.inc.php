<?php
if(isset($_POST['check'])){
    include 'dbh.php';
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM login WHERE uname='$uname' OR email='$uname'; ";
    $que = $conn->query($sql);
        if($row = mysqli_fetch_assoc($que)){
            if($pwd != $row['pwd']){
                echo '2';
                exit();
            }else if ($pwd == $row['pwd']){
                session_start();
                $_SESSION['uid'] = $row['uid'];
                echo '3';
                exit();
            }else{
                echo '4';
                exit();
            }
        }else{
            echo '1';
            exit();
        }

}else{
    header("location:../");
}
