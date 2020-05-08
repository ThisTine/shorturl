<?php
include 'inc/verify.php';
include 'replace/needtoreplace.php';
?>
<?php
session_start();
include 'inc/dbh.php';
$link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]s/";
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM `login` WHERE uid='$uid'";
$que = $conn->query($sql);
$row = mysqli_fetch_assoc($que);
if($row['role'] == '1'){
    $sort = $_GET['sort'];
if(!isset($_GET['sort'])){
    $sort_btw = "all";
}elseif($_GET['sort'] == "me" || $_GET['sort'] == "notme" || $_GET['sort'] == "unknown" ){
    $sort_btw = $_GET['sort'];
}else{
    $sort_btw = "me";
}
}else{
    $sort = "me";
}

?>
<html>
<head>
<title>Account</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="css/user.css?v=<?php $time=time();echo $time;?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/3fed5e4391.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src='preloader.js'></script>
<script>
    $(document).ready(function(){
        <?php
        if($row['role'] == "1"){
            echo '$("#'.$sort_btw.'").addClass("active");';
        }
        ?>        
        $("#barnav").click(function() { 
            $("#realnav").animate({width:"100%"});
            $("main").animate({overflow:"hidden"});
            
        });
        $("#back").click(function() { 
            $("#realnav").animate({width:"0%"});
            $("main").animate({overflow:"none"});
            
        });
        $("#pin").keyup(function(){
            var pin = $(this).val()
            var oldpin = $("#oldpin").val()
            if(pin.length == 0){
                $("#error").html("<span class='text-info'>Pin will be disable</span>");
                $("#pinsetup").removeAttr("disabled");
            }else if(pin.length >= 1 && pin.length <= 3){
                $("#error").html("<span class='text-danger'>Pin has to be 4 digit or more</span>");
                $("#pinsetup").attr('disabled', 'disabled');
            }else if(pin === oldpin){
                $("#error").html("<span class='text-danger'>This pin is same as the old one</span>");
                $("#pinsetup").attr('disabled', 'disabled');
            }
            else if(pin.length >= 0){
                $("#error").html("");
                $("#pinsetup").removeAttr("disabled");
            }else{
                alert(error);
            }
        });
        $("#pinsetup").click(function(){
            var pin = $("#pin").val()
            var id = $(this).val()
            if(pin.length >= 4){
                var realpin = pin
            }else{
                var realpin = "0"
            }
            
            $.post("inc/pin.php", {
                id: id,
                pin: realpin,
                check: "woohhhhhhhhhhhhhhhh"
            },
                function (data) {
                    $("#error").html(data);
                }
            );
        });
    });
</script>
</head>
<body style="display:block;">
<?php include 'incq/preloader.php';?>
    <?php include 'incq/header.admin.php';
    include 'incq/copymodal.php' ?>
    <main>
    <div id="search">
    <div id="crop"><h1 class="d-none d-sm-block d-sm-none d-md-block">Search for your data</h1>
    <div class="input-group mb-2 mr-sm-2" id="rese">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-search"></i></div>
    </div>
    <input class="form-control form-control-lg" type="text" id="tablesearch">

  </div>
  <?php
    if($row['role']=="1"){
        include 'incq/btw.php';
    }
    ?>
    </div>
    
    </div>
    <div id="crop">
    <div id="datahere">
    <?php
    include 'inc/dbh.php';?>
    <div class="table-responsive">
    <table id="table_id" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="display:none;" >id</th>
            <th >Redirect</th>
            
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php
    if(!isset($sort)){
        $sql3 = "SELECT * FROM link";
    }elseif($sort == "me"){
        $sql3 = "SELECT * FROM link WHERE uid = '$uid';";
    }elseif($sort == "notme"){
        $sql3 = "SELECT * FROM link WHERE uid != '$uid' && uid != 0;";
    }elseif($sort == "unknown"){
        $sql3 = "SELECT * FROM link WHERE uid=0;";
    }else{
        $sql3 = "SELECT * FROM link WHERE uid = '$uid';";
    }
    
    $que = $conn->query($sql3);
    while($table = mysqli_fetch_assoc($que)){
        $uid1 = $table['uid'];
        if($uid1 == 0){
            $uname = "unkown";
        }else{
            $sql2 = "SELECT uname FROM login WHERE uid='$uid1'";
            $que2 = $conn->query($sql2);
            $fec2 = mysqli_fetch_assoc($que2);
            $uname = $fec2['uname'];
        }
        if($table['pin'] == 0){
            $table['pin'] = "";
            $error = "btn-warning";
        }else{
            $error = "btn-info";
        }
        if($row['role'] == "1"){
            $admin = '<input readonly class="form-control" value="'.$uname.'" style="width:20%" data-toggle="tooltip" data-placement="top" title="Owner">';
            $width = "80%";
        }else{
            $admin = '';
            $width = "100%";
        }
        echo '<tr>';
        echo '<td style="display:none;">'.$table['sid'].'</td>';
        echo '<td style=" width:50%;"><div class="form-inline">'.$admin.'<p style="display:none;">'.$table['path'].'</p><p style="display:none;">'.$table['link'].'</p><input style="width:'.$width.'" class="form-control" data-toggle="tooltip" data-placement="top" title="'.$shotlinkpath.'/'.$table['path'].'" value="'.$table["link"].'"  readonly></div></td>';
        echo '<td style=" width:50%;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#copymodal" data-path="'.$table["path"].'" style="color:white;"><i class="fas fa-copy"></i></button> 
        <a class="btn btn-danger" style="color:white;" data-toggle="modal" data-target="#deletemodal" data-id="'.$table['sid'].'" data-path="'.$table['path'].'"><i class="fas fa-times"></i></a> 
        <a class="btn '.$error.'" style="color:white;" data-toggle="modal" data-target="#configmodal" data-id="'.$table['sid'].'" id="pinkey" data-pin="'.$table['pin'].'"><i class="fas fa-key"></i></a>
        </td>';
        echo '</tr>';
    }
    ?>
    </tbody>
    </table>
    </div>
    
    </div>


    </div>
    <div style="padding-top:20px;"><p style="text-align:center">©Thistine.com</p></div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script>
    $(document).ready(function () {
        $("#deleteitplease").click(function() { 
            var id = $(this).val();
            $.post("inc/delete.php", {
                id: id,
                check: "yeahhhhhhhhhhh"
            },
                function (data) {
                    $("#2ndtexthere").html(data);
                    setTimeout(function(){
                        location.reload(true);
                    }, 500);
                });
        });
    });

</script>
<script>
    $('#deletemodal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var path = button.data('path')
  var id = button.data('id')
  var modal = $(this)
  modal.find('#2ndtexthere').text('<?php echo $shotlinkpath."/";?>' + path)
  modal.find('#deleteitplease').val(id)
});
$('#configmodal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var pinpass = button.data('pin')
  var modal = $(this)
  modal.find('#pinsetup').val(id)
  modal.find('#pin').val(pinpass)
  modal.find('#oldpin').val(pinpass)
  modal.find('#error').html("")
})


</script>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(function () {
  $('[data-toggle="popover"]').popover()
})
$(document).ready( function () {

    $('#table_id').DataTable({
        "rowReorder": true,
        "info":     false,
        "lengthChange": false,
        "dom": 'lrtip',
        "order": [[ 0, "desc" ]]
    });

    var table = $('#table_id').DataTable();
    $('#tablesearch').on( 'keyup', function () {
    table.search( this.value ).draw();});

$('#copymodal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var path = button.data('path')
  var modal = $(this)
  modal.find('#pathhere').val('<?php echo $shotlinkpath."/";?>' + path);
});
});
</script>

<script>
    $(document).ready(function () {
        $('#copy').on('click', function(){
	var note = $("#pathhere").val();
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