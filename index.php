<?php
/*
if you want to use a normal url;
$link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]s/";
*/
include 'replace/needtoreplace.php';
?>
<html>
<head>
<title>Short link</title>
<link rel="stylesheet" href="css/main.css?v=<?php $time=time();echo $time;?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/3fed5e4391.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='preloader.js'></script>
<script>
    $(document).ready(function(){
        $("#model").hide();
        $("#input-path").keypress(function(e){
     var keyCode = e.which;
    if ( (keyCode != 8 || keyCode ==32) && (keyCode < 97 || keyCode > 122) && (keyCode < 48 || keyCode > 57))  { 
      return false;
    }
  });
        $("#input-path").keyup(function(){ 
            var text = $("#input-path").val();
            $("#text").html(text);
            $.post("inc/check.php", {path: text, sts: "yes"},
                function (data,status) {
                    var pathdata = data;
                    if(data == '1'){
                        $("#alert").html("<span class='success'>This path can be use<span>");
                        $("#btwsubmit").removeClass("disabled");
                        $("#btwsubmit").removeAttr("type");
                        $("#btwsubmit").attr("type","submit");
                        $("#btwsubmit").addClass("enable");
                    }else if(data == 3){
                        $("#alert").html("");
                    }else{
                        $("#alert").html("<span class='fail'>This path is in use</span>");
                        $("#btwsubmit").removeAttr("type");
                        $("#btwsubmit").attr("type","button");
                        $("#btwsubmit").removeClass("enable");
                        $("#btwsubmit").addClass("disabled");
                    }
                });
        });
        $("#s-form").submit(function (e) { 
            e.preventDefault();
            var path = $("#input-path").val();
            var web = $("#input-website").val();
            $.post("inc/sub.inc.php", {
                path: path,
                web: web,
                sub: "yes",
                },
                function (data,status) {
                    var webpath = "<?php echo $shotlinkpath;?>/"+path
                    $("#alert").html(data);
                    $("input").val("");
                    $("#model").fadeIn("fast",function(){
                        $("#model").show();
                        $("#coptext").html(data);
                        $("#copyinput").val(webpath);
                    });
                });
        });
        $("#model").click(function(){
            $(this).fadeOut("slow", function(){
                $(this).hide();
                $("#coptext").html("Success !");
            });
        });
        $("#home").addClass("active");
    });

</script>
<script>
    $(document).ready(function () {
        $('#copyinput').on('click', function(){
            $("#coptext").html("Copied !");
	var note = $("#copyinput").val();
	CopyToClipboard(note);
});
    });

function CopyToClipboard(note) {
    function listener(e) {
        e.clipboardData.setData("text/html", note);
        e.clipboardData.setData("text/plain", note);
        e.preventDefault();
    }
    document.addEventListener("copy", listener);
    document.execCommand("copy");
    document.removeEventListener("copy", listener);
}
</script>
</html>
</head>
<body>
<?php include 'incq/preloader.php'; ?>
    <div id="model"> <div id="card"><h1 id="coptext">Success ! </h1>
    <input type="text" id="copyinput" readonly>
</div> </div>
    <?php include 'incq/header.php'; ?>
    <main>
        <div class="flex">
        <div><h1>Shorten your link</h1></div>
        <div class="order">
        <p> <?php echo $shotlinkpath."/"; ?><span id="text"></span></p>
        </div>
        <form id="s-form" action="inc/sub.inc.php" method="post">
        <div class="input-web">
        <input type="text" name="path" required placeholder="path" id="input-path" oninvalid="this.setCustomValidity('Please enter the path')">   
        <span class="underline-animation"></span>
        </div>
        <div class="input-web">
        <input type="text" name="web" required placeholder="www.example.com" id="input-website">   
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
        <button type="submit" class="enable" id="btwsubmit" name="sub">Shorten</button>
        </form>
        <p>©Thistine.com</p>
        </div>

    </main>

</body>
</html>