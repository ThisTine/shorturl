<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/pin.css?v=<?php $time=time();echo $time;?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>pin required</title>
    <script>
      $(document).ready(function() {
        $(".close").click(function(){
          $("#error").fadeOut();
        });
        $("form").submit(function(e){ 
          e.preventDefault();
          var id = $("#id").val()
          var pin = $("#input").val()
          $.post("../inc/url.php", {
            id: id,
            pin: pin,
            check: "baraw"
            },
                function (data) {
                  if(data == "0"){
                    $("#input").removeClass("input-border-color-black");
                    $("#input").addClass("input-border-color-red");
                    $('#error').fadeIn();
                  }else{
                    window.open(data,"_self");
                  }
                  
                }
            );
        });
      });
    </script>
  </head>
  <body>
    <div id="crop">
    <h2 id="h1">PIN REQUIRED</h2>
    <form action="../inc/pin.php" method="post">
    <input id="id" type="hidden" name="id" value="<?php echo $_GET['s']?>">
    <input id="input" class="input-border-color-black" require name="pin" class="form-control form-control-lg" type="number" autocomplete="off" >
    <button type="submit" name="check" id="btw" class="btn btn-block btn-light btn-lg" >Submit</button>
    <p style="color:white;margin-top:35px;">©Thistine.com</p>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Incorrect PIN !</strong>
  <button type="button" class="close" >
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  </body>

</html>