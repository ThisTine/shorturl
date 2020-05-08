<?php
session_start();
if(isset($_SESSION['uid'])){
    header("location:account");
}
include 'inc/dbh.php';
$sql = "SELECT * FROM settings WHERE settings='register'";
$que = $conn->query($sql);
$row = mysqli_fetch_assoc($que);
if($row['value'] == 0){
    header('location:login');
}
?>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="css/main.css?v=<?php $time=time();echo $time;?>">
<style>
    :root{
    --main-color:#37DC94;
    --hover-color:#FA5C65 ;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/3fed5e4391.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='preloader.js'></script>
<script>
    $(document).ready(function () {
        $("#account").addClass("active");
        $("#s-form").submit(function (e) { 
            $("#alert").html("");
            e.preventDefault();
            var uname = $("#input-uname").val();
            var email = $("#input-email").val();
            var pwd = $("#input-password").val();
            if(uname.length == 0 || email.length == 0 || pwd.length == 0){
                $("#alert").append("Please enter your ");
                if(uname.length == 0){
                    $("#input-uname").addClass('error');
                    $("#alert").append("Username ");
                }
                if(uname.length == 0 && email.length == 0){
                    $("#alert").append("and ");
                }
                if(email.length == 0){
                    $("#input-email").addClass('error');
                    $("#alert").append("Email ");
                }
                if(email.length == 0 && pwd.length == 0){
                    $("#alert").append("and ");
                }
                if(pwd.length == 0){
                    $("#input-password").addClass('error');
                    $("#alert").append("Password ");
                }
            }else{
                $.post("inc/register.inc.php", {
                    uname: uname,
                    email: email,
                    pwd: pwd,
                    check: "asdlw"
                },
                    function (data) {
                     $("#alert").append(data)
                     if(data === 'success'){
                         setTimeout(() => {
                            window.location.replace("login");
                         }, 1000);
                     }
                    }
                );
            }
            
        });
    });
    

</script>
</head>
<body>
<?php include 'incq/preloader.php'; ?>
    <?php include 'incq/header.php'; ?>
    <main>
        <div class="flex">
        <div><h1>Register</h1></div>
        <form id="s-form" method="post">
        <div class="input-web">
        <input type="text" name="uname"  placeholder="Username" id="input-uname">   
        <span class="underline-animation"></span>
        </div>
        <div class="input-web">
        <input type="email" name="Email"  placeholder="Email" id="input-email">   
        <span class="underline-animation"></span>
        </div>
        <div class="input-web">
        <input type="password" name="web"  placeholder="Password" id="input-password">   
        <span class="underline-animation"></span>
        </div>
        <p id="alert" class='fail'></p>
        <button type="submit" class="enable" id="btwsubmit" name="sub">Register</button>
        <div class="log-retext">
        <a class="log-re" href="login">login</a>
        </div>
        </form>
        <p>©Thistine.com</p>
        </div>

    </main>

</body>
</html>