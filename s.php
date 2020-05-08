<?php
if(isset($_GET['s'])){
    include 'inc/dbh.php';
    $s = $_GET['s'];
    $sql = "SELECT * FROM link WHERE path='$s';";
    $que = $conn->query("$sql");
    if($fec = mysqli_fetch_assoc($que)){
        if($fec['pin'] == 0){
            $link = $fec[link];
            header("location:https://".$link);
        }else{
            include 'incq/pinreq.php';
        }
    }else{
        echo 'This link might be disable';
    }


}else{
    header("location:index.php");
}