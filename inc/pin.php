<?php
$pin = $_POST['pin'];
$sid = $_POST['id'];
if(isset($_POST['check'])){
    include 'dbh.php';
    $sql = "UPDATE `link` SET `pin`='$pin' WHERE sid='$sid';";
    $conn->query($sql);
    echo "<span class='text-success'>Success</span>";
}else{
    header("location:../");
}
