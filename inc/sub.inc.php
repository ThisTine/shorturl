<?php
$web = $_POST['web'];
$path = $_POST['path'];
if(isset($_POST['sub'])){
    session_start();
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }else{
        $uid = "0";
    }
    include 'dbh.php';
    $sql = "SELECT uid FROM link WHERE path = '$path';";
    $que = $conn->query($sql);
    if(mysqli_fetch_assoc($que)){
    echo("<span class='failed'>Failed This path has been used.</span>");
    }else{
    $notwant = "https://";
    $notwant2 = "http://";
    $tim = str_replace($notwant,'',$web);
    $webtim = str_replace($notwant2,'',$tim);
    $sql = "INSERT INTO `link`(`path`, `link`, `uid`) VALUES ('$path','$webtim', '$uid')";
    $que = $conn->query("$sql");
    echo("<span class='success'>Success</span>");
    }
}else{
    header("location:../");
}