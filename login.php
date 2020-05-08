<?php
session_start();
if(isset($_SESSION['uid'])){
    header("location:account");
}
?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/main.css?v=<?php $time=time();echo $time;?>">
<style>
    :root{
    --main-color:#26A7FF;
    --hover-color:#FF5126 ;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/3fed5e4391.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='preloader.js'></script>
<script>
    $(document).ready(function () {
        $("#account").addClass("active");
        $("#s-form").submit(function(e){
            e.preventDefault();
            $("#input-name").removeClass("error");
            $("#input-password").removeClass("error");
            $("#alert").html("");
            var uname = $("#input-name").val();
            var password = $("#input-password").val();
            if(uname.length == 0 || password.length == 0){
                $("#alert").append("<span class='fail'>Please Enter <span>");
                if(uname.length == 0){
                $("#input-name").addClass("error");
                $("#alert").append("<span class='fail'>Username<span>");
                }
                if(uname.length == 0 && password.length == 0){
                    $("#alert").append("<span class='fail'> and <span>");
                }
                if(password.length == 0){
                    $("#input-password").addClass("error");
                    $("#alert").append("<span class='fail'>password<span>");
            }
            } else{
                $.post("inc/login.inc.php", {
                uname: uname,
                pwd: password,
                check: "yes",
                },
                function (data,status) {
                    if(data == "1"){
                        $("#input-name").addClass("error");
                        $("#alert").append("<span class='fail'>Incorrect Username<span>");
                    }else if(data == "2"){
                        $("#input-password").addClass("error");
                        $("#alert").append("<span class='fail'>Incorrect Passowrd<span>");
                    }else if(data == "3"){
                        $("#btwsubmit").removeAttr("type");
                        $("#btwsubmit").attr("type","button");
                        $("#btwsubmit").removeClass("enable");
                        $("#btwsubmit").addClass("disabled");
                        $("#btwsubmit").empty();
                        $("#btwsubmit").append("<span class='success'>Logging in</span>");
                        setTimeout(function(){
                            window.open("account","_self");
                        }, 1000);
                    }
                });

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
        <div><h1>Login</h1></div>
        <form id="s-form" method="post">
        <div class="input-web">
        <input type="text" name="uname"  placeholder="Username,Email " id="input-name" oninvalid="this.setCustomValidity('Please enter the username')">   
        <span class="underline-animation"></span>
        </div>
        <div class="input-web">
        <input type="password" name="web"  placeholder="Password" id="input-password">   
        <span class="underline-animation"></span>
        </div>
        <?php
        if(isset($_GET['sts'])){
            if($_GET['sts']== "1"){
            echo '<p id="alert success">Success !</p>';    
            }
            
        }
        ?>
        <p id="alert"></p>
        
        <button type="submit" class="enable" id="btwsubmit" name="sub">Login</button>


        <?php
        include 'inc/dbh.php';
        $sql = "SELECT * FROM settings WHERE settings='register'";
        $que = $conn->query($sql);
        $row = mysqli_fetch_assoc($que);
        if($row['value'] == 1){
            echo '
            <div class="log-retext">
            <a class="log-re" href="register">register</a>
            </div>
            ';
        }
        ?>


        
        
        </form>
  
        
        <p>©Thistine.com</p>
        </div>

    </main>

</body>
</html>