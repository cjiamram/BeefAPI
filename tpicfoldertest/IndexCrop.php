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
 <link rel="stylesheet" href="jquery.Jcrop.min.css" type="text/css" />
<script src="jquery.min.js"></script>
<script src="jquery.Jcrop.min.js"></script>


 <section class="content container-fluid">
 <div class="from-group">
 	<div class="col-sm-2">
 		<label >Choose Picture :</label>
 	</div>
 	<div class="col-sm-4">
 		<select id="obj_choosePic" class="form-control">
 		</select>
 	</div>
 	<div class="col-sm-9">
 	</div>
 </div>
 <div class="form-group">
 	<div class="col-sm-12">
 		<div>
        	<img  id="obj_cropbox" class="img" /><br />
    	</div>
 	</div>
 	
 </div>
 </section>

 <script>
 	function listPicture(){
 		var url ="<?=$rootPath?>/tpicfoldertest/getData.php";
 		//console.log(url);
 		setDDLPrefix(url,"#obj_choosePic","****Choose Picture****");
 	}

 	$(document).ready(function(){
 		listPicture();
 		
 		 var size;
        $('#obj_cropbox').Jcrop({
          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};
           area={x:c.x,y:c.y,w:c.w+c.x,h:c.h+c.y};
           //$("#crop").css("visibility", "visible");     
          }
        });


 		$("#obj_choosePic").change(function(){
 		
 			//console.log($("#obj_choosePic").val());
 			$('#obj_cropbox').attr('src',$("#obj_choosePic").val());
 			//$("#obj_cropbox").attribute("src",$("#obj_choosePic").val());
 		});	
 	});

 </script>