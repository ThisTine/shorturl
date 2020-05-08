<?php
$sid = $_POST['id'];
if(isset($_POST['check'])){
    include 'dbh.php';
    session_start();
    $uid = $_SESSION['uid'];
    $sql = "SELECT role FROM login WHERE uid ='$uid';";
    $que = $conn->query($sql);
    $fec = mysqli_fetch_assoc($que);
    if($fec['role'] == '2'){
        $sql = "SELECT uid FROM link WHERE sid = '$sid';";
        $que = $conn->query($sql);
        $fec = mysqli_fetch_assoc($que);
        if($fec['uid'] == $uid){
            $sql = "DELETE FROM link WHERE sid='$sid'";
            mysqli_query($conn,$sql);
            echo "success";
        }else{
            echo "You can't delete this id";
        }
    }elseif($fec['role'] == '1'){
        $sql = "DELETE FROM link WHERE sid='$sid'";
        mysqli_query($conn,$sql);
        echo "success";
    }else{
        echo 'sql error';
    }

}else{
    header('location:../');
}