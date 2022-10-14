<html>
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/skin-blue.css">
<link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui.css"/>
<link rel="stylesheet" href="dist/css/jquery-confirm.css">
<link rel="stylesheet" href="css/jquery.toast.css">
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style >
.main-wrapper{
  -webkit-transition: -webkit-transform 0.1s ease-in-out, margin 0.1s ease-in-out;
  -moz-transition: -moz-transform 0.1s ease-in-out, margin 0.1s ease-in-out;
  -o-transition: -o-transform 0.1s ease-in-out, margin 0.1s ease-in-out;
  transition: transform 0.1s ease-in-out, margin 0.1s ease-in-out;
  margin-left: 0px;
  z-index: 820;
   background-color: #4C3979;
}
</style>
<body>
  <div id="dvMain" class="main-wrapper">

  </div>
</body>

<?php
  session_start();
  $userCode=isset($_GET["userCode"])?$_GET["userCode"]:"Admin";
  $_SESSION["userCode"]=$userCode;
?>

<input type="hidden" id="obj_userCode" value='<?=$userCode?>'>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="js/component.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="js/jquery-1.12.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="js/canvasjs.min.js"></script>
<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.toast.js"></script>

<script >
  $(document).ready(function(){
    var url="/BeefAPI/tbeef/displayBeefInfo.php?userCode=<?=$userCode?>";
    $("#dvMain").load(url);
  });

</script>
</html>