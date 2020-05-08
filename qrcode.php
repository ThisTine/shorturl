<?php
$link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]s/";
?>
<html>
<head>
<title>Create QR code</title>
<link rel="stylesheet" href="css/main.css?v=<?php $time=time();echo $time;?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/3fed5e4391.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='preloader.js'></script>
<style>
    :root{
    --main-color:#37DC94 ;
    --hover-color: #FA5C65;
    }
    @media only screen and (max-width: 600px) {
    main{
        justify-content:flex-start;
        margin-top:10px;
    }
    .flex{
        padding-top:30px;
        padding-bottom:20px;

        height: 100%;
        width:95vw;
    }
    header{
        bottom:40px;
        height:10px;
    }
    header>nav>div{
        height:10px;
        font-size: 1.5em;
    }
    .desktop {
        display: none;
    }
}
</style>
<script>
    $(document).ready(function(){
        $("#qrcode").keyup(function(){
            var qrtext = $(this).val();
            if(qrtext.length == 0){
                qrtext = "thistine.com";
            }
            $("#qrimg").attr("src","https://chart.apis.google.com/chart?cht=qr&chs=250x250&chld=L|0&chl="+qrtext);
        });
        $("#btw").click(function() { 
            var qrtexturl = $("#qrcode").val();
            if(qrtexturl.length == 0){
                qrtexturl = "thistine.com";
            }
            var image = new Image();
            image.crossOrigin = "anonymous";
            image.src = "https://chart.apis.google.com/chart?cht=qr&chs=500x500&chld=L|0&choe=UTF-8&chl="+qrtexturl;
            var fileName = image.src.split(/(\\|\/)/g).pop();
            image.onload = function () {
            var canvas = document.createElement('canvas');
            canvas.width = this.naturalWidth;
            canvas.height = this.naturalHeight;
            canvas.getContext('2d').drawImage(this, 0, 0);
            var blob;
            if (image.src.indexOf(".jpg") > -1) {
            blob = canvas.toDataURL("image/jpeg");
            } else if (image.src.indexOf(".png") > -1) {
            blob = canvas.toDataURL("image/png");
            } else if (image.src.indexOf(".gif") > -1) {
            blob = canvas.toDataURL("image/gif");
            } else {
            blob = canvas.toDataURL("image/png");
            }
            $("#btw").attr("href",blob);
            $("#btw").attr("download", qrtexturl+".png");
            $("#btw").trigger("click");
            setTimeout(function(){
            $("#btw").removeAttr("href");
            $("#btw").removeAttr("download");
            },1000);
            };
            return 0;
        });
        $("#qrmenu").addClass("active");
    });
</script>
</head>
<body>
    <?php include 'incq/preloader.php'; ?>
    <?php include 'incq/header.php'; ?>
    <div id="mobile" style="padding:70px;"></div>
    <main>
        <div class="flex" style="height:75vh;">
        <div><h1>Create QR code</h1></div>
        <div class="order">
        <img id="qrimg" src="https://chart.apis.google.com/chart?cht=qr&chs=250x250&chld=L|0&choe=UTF-8&chl=thistine.com" alt="">
        </div>
        <div id="s-form">
        <div class="input-web">
        <input type="text" required placeholder="www.thistine.com" id="qrcode">   
        <span class="underline-animation"></span>
        </div>
        <?php
        if(isset($_GET['sts'])){
            if($_GET['sts']== "1"){
            echo '<p id="alert success">Success !</p>';    
            }
            
        }
        ?><br>
        <a class="enable" id="btw">Download</a>
        </div>
        <p>©Thistine.com</p>
        </div>

    </main>

</body>
</html>