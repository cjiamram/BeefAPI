 <?php
 include_once "../config/config.php";
 include_once "../config/database.php";
 include_once "../objects/tpicfoldertest.php";
 $cnf=new Config();
 $rootPath=$cnf->path;
 $database=new Database();
 $db=$database->getConnection();
 $obj=new tpicfoldertest($db);

 ?>
 <link rel="stylesheet" href="./css/jquery.Jcrop.min.css" type="text/css" />
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery.Jcrop.min.js"></script>
 <style type="text/css">
		input#crop {
		    padding: 5px 25px 5px 25px;
		    background: lightseagreen;
		    border: #485c61 1px solid;
		    color: #FFF;
		    visibility: hidden;
		}
</style>

 <section class="content container-fluid">
 <div class="from-group">
 	<div class="col-sm-1">
 		<label >Choose Picture :</label>
 	</div>
 	<div class="col-sm-2">
 		<select id="obj_choosePic" class="form-control">
 		</select>
 	</div>
 	<div class="col-sm-9">
 	</div>
 </div>
 <div class="form-group">
 	<div class="col-sm-9">
 		<div>
        	<img  id="obj_cropbox" class="img" /><br />
    	</div>
 	</div>
 	<div class="col-sm-3">
 	</div>
 </div>
 </section>

 <script>
 	function listPicture(){
 		var url ="<?=$rootPath?>/tpicfoldertest/getData.php";
 		setDDL(url,"#obj_choosePic");
 	}

 	$(document).ready(function(){
 		listPicture();
 		$("#obj_choosePic").change(function(){

 			//console.log($("#obj_choosePic").val());	

 			$("#obj_cropbox").attr("src",$("#obj_choosePic").val());
 		});	
 	});

 </script>