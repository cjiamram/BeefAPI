 <?php
 	header("content-type:html/text;charset=UTF-8");
 	include_once "../config/config.php";
 	include_once "../config/database.php";	
 	include_once "../objects/tpicfoldertest.php";

 	$cnf=new Config();
 	$rootPath=$cnf->path;
  $aiURL=$cnf->deepURL;
 	$database=new Database();
 	$db=$database->getConnection();
 	$obj=new tpicfoldertest($db);
 	$id=isset($_GET["id"])?$_GET["id"]:0;

 	$picture=$rootPath."/".$obj->getPicture($id);
  $size=$obj->getImageSize($id,1);
  $sizeStyle="width:".$size["width"]."px;height:".$size["height"]."px";
  $sizeW=$size["width"];
  $sizeH=$size["height"];
  //print_r($picture);
  echo '<input type="hidden" id="hdn_picture" value="'.$picture.'">';
 ?>
  
  <div style="overflow:scroll; height:400px;width:100%"> 
  <img src="<?=$picture?>" id="cropbox" style="<?=$sizeStyle?>"  />
 </div>     
<script>
  var jsonInfos;
  var sizeW=<?=$sizeW?>;
  var sizeH=<?=$sizeH?>;
  function getClassE(file){
      var f = file.split("/");
      var l=f.length;
      var fl=f[l-1];
      var url="<?=$rootPath?>/tpicfoldertest/getClassE.php?f="+f;
      //console.log(fl);
      var data=queryData(url);
      return data.classStatus;

  }

  function execPost(url,jsonObj){
    var jsonData=JSON.stringify (jsonObj);
    var result;
      $.ajax({
        //**************
          url: url,
          contentType: "application/json; charset=utf-8",
          type: "POST",
          dataType: "json",
          data:jsonData,
          async:false,
          success: function(data){
            result=data;
          } 
        //**************
      });
      return result;
  }



  function displayResult(data){
          strDetail="<tr>\n";
          strDetail+="<td>"+data.fileName+"</td>\n";
          strDetail+="<td>["+data.area+"]</td>\n";
          strDetail+="<td>"+data.class+"</td>\n";
          strDetail+="<td>"+data.weight+"</td>\n";
          strDetail+="<td>"+data.confidence+"</td>\n";
          strDetail+="</tr>\n";
         $('#tbResult').append(strDetail);
  }


	$(document).ready(function(){
		var size;
        
        $('#cropbox').Jcrop({

          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};
           area={
              x1:c.x,
              y1:c.y,
              x2:c.w+c.x,
              y2:c.h+c.y,
              W:sizeW,
              H:sizeH
            };
           
          }
        });

        $("#obj_crop").click(function(){
            var url="<?=$aiURL?>/cropClassify"; 
            var picture=$("#hdn_picture").val();

            jsonInfos={
              file:picture,
              area:area
           }
           var data=execPost(url,jsonInfos);
           displayResult(data);
           jsonInfos = new Object; 
           data = new Object; 
        });
	})

</script>