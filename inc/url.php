<?php
    $pin = $_POST['pin'];
    $path = $_POST['id'];
    if(isset($_POST['check'])){
        include 'dbh.php';
        $sql = "SELECT * FROM link WHERE path='$path'";
        $que = $conn->query($sql);
        $fec = mysqli_fetch_assoc($que);
        $realpin = $fec['pin'];
        $url = "https://".$fec['link'];
        if($pin == $realpin){
            echo $url;
        }else{
            echo '0';
        }

    }else{
        header("location:../");
    }