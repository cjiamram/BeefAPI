 <?php
		header("content-type:text/html;charset=UTF-8");
		include_once "../config/config.php";
		include_once "../config/database.php";	
		include_once "../objects/tbeef.php";

		$cnf=new Config();
		$rootPath=$cnf->path;
		$aiURL=$cnf->deepURL;
		$picPath=$cnf->picPath;
		$database=new Database();
		$db=$database->getConnection();
		$obj=new tbeef($db);
		$folder=isset($_GET["folder"])?$_GET["folder"]:"N001";
		$picture=isset($_GET["picture"])?$_GET["picture"]:"1.jpg";

		$physicalPath=$folder."/".$picture;

		$picture=$cnf->picPath.$folder."/".$picture;
		$size=$obj->getImageSize($picture);


		$sizeStyle="width:".$size["width"]."px;height:".$size["height"]."px";
		$sizeW=$size["width"];
		$sizeH=$size["height"];
		echo '<input type="hidden" id="hdn_picture" value="'.$physicalPath.'">';
?>

 <div style="overflow:scroll; height:500px;width:100%;min-width:500px"> 
  		<img src="<?=$picture?>" id="cropbox" style="<?=$sizeStyle?>"  />
 </div>

   <div class="toast">
    <div class="toast-header">
      Beef Information
    </div>
    <div class="toast-body">
      <div id='dvContent'></div>
    </div>
  </div>
</div>

 <link rel="stylesheet" href="<?=$rootPath?>/css/jquery.Jcrop.min.css" type="text/css" />
<script src="<?=$rootPath?>/js/jquery.min.js"></script>
<script src="<?=$rootPath?>/js/jquery.Jcrop.min.js"></script>
<script src="<?=$rootPath?>/js/component.js"></script>

 <script>

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

  function displayCrop(){
  	
  	let length = beefInfos.length;
  	strT="<table width='100%' border='1'>\n";
  	strT+="<thead>\n";
  	strT+= "<tr><th colspan='3'><h3>ข้อมูลการประเมินคุณภาพเนื้อ</h3></th></tr>\n";
  	strT+="<th>ไขมันแทรก</th>\n";
  	strT+="<th>เนื้อแดง</th>\n";
  	strT+="<th>สัดส่วน(%)</th>\n";
  	strT+="</thead>\n";
  	strT+="<tbody>\n";
  	for(i=0;i<length;i++){
  		strT+="<tr>\n";
  		strT+="<td>"+beefInfos[i].fatArea+"</td>\n";
  		strT+="<td>"+beefInfos[i].beefArea+"</td>\n";
  		strT+="<td>"+beefInfos[i].ratio.toFixed()+" %</td>\n";
  		strT+="</tr>\n";
  	}
  	strT+="</tbody>\n";
  	strT+="</table>\n";
  	$("#dvCropInfo").html(strT);
  }

  

  	function createByCrop(data,beefCode,beefNo,userCode){
    		var urlCnt="<?=$rootPath?>/tclassifytransaction/getCountFraction.php?beefCode="+beefCode+"&beefNo="+beefNo+"&userCode="+userCode;
        
     

        var dataCnt=queryData(urlCnt);
        if(dataCnt.cnt<10){   
            var url="<?=$rootPath?>/telementtransaction/create.php";
        		square=JSON.stringify(data.area);
               /*var myToast = $.toast({
                heading: 'Beef Information',
                text: 'พื้นที่การ Scan คือ'+square+" พื้นที่เนื้อ "+data.beefArea+" ไขมันแทรก "+data.fatArea,
                icon: 'info',
                hideAfter: false
              });*/


            var strToast='พื้นที่การ Scan บริเวณ '+square+" พื้นที่เนื้อ "+  (data.beefArea*0.26/100).toFixed(2)  +" (cm^2) พื้นที่ไขมันแทรก "+(data.fatArea*0.26/100).toFixed(2)+ "cm^2";

              swal.fire({
                    title: "ผลการวิเคราะห์เนื้อ",
                    text:strToast,
                    type: "success",
                    confirmButtonText: "ปิด",
                    showConfirmButton: true
                });

            		var jsonObj={
                  			fat:data.fatArea,
                  			beef:data.beefArea,
                  			ratio:data.ratio,
                  			beefCode:beefCode,
                  			beefNo:beefNo,
                  			square:square,
                        fraction:data.fraction,
                        userCode:userCode
              		}

              		jsonData=JSON.stringify(jsonObj);

              		var flag=executeData(url,jsonObj,false);
              		return flag;
          }
          else{
              swal.fire({
                  title: "ไม่สามารถเลือกบริเวณมากกว่า 10 ชุดข้อมูล",
                  type: "error",
                  confirmButtonText: "ตกลง",
                  showConfirmButton: true
              });
          }
  	}

 	$(document).ready(function(){
 		var size;
 		var jsonInfos;
  		var sizeW=<?=$sizeW?>;
  		var sizeH=<?=$sizeH?>;
  		var file=$("#hdn_picture").val();
        
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
		             var jsonObj={
		             	file:file,area:area
		             }

		             var jsonData=JSON.stringify(jsonObj);

		             var url="<?=$aiURL?>/getElementDetail";
		             var data=execPost(url,jsonObj);
		             if(data.beefArea!==0&&data.fatArea!==0){
		                	var flag= createByCrop(data,$("#obj_beefCode").val(),$("#obj_beefNo").val(),$("#obj_userCode").val());
		             }else{
                      swal.fire({
                          title: "บริเวณดังกล่าวไม่สามารถประมวลผลได้!",
                          type: "error",
                          confirmButtonText: "ตกลง",
                          showConfirmButton: true
                      });
                 }

		             displayResult();
		          }
		        });

 	});
 </script> 

