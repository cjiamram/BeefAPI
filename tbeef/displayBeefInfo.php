<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $module=$cnf->systemModule;

      $rootPath=$cnf->path;
      $picPath=$cnf->picPath;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);

      function mb_basename($path) {
            if (preg_match('@^.*[\\\\/]([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            } else if (preg_match('@^([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            }
            return '';
      }
      $dir= getcwd();

      $lastPath=mb_basename($dir);
      $lblInput= $objLbl->getLabel("t_beef","BeefInfomation","th");


?>

<style>
	.crop {
	    padding: 5px 25px 5px 25px;
	    background: lightseagreen;
	    border: #485c61 1px solid;
	    color: #FFF;
	    visibility: hidden;
	}

	#obj_cropImg {
	    margin-top: 40px;
	}

	.preLoad {
    width: 150px;
    height: 150px;
    z-index: 9999;
    background: url(IMG/spinning-arrows.gif) center no-repeat #fff;
}

.afterLoad {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
}
</style>

<input type='hidden' id='obj_beefCode' value=''>
<input type='hidden' id='obj_beefNo' value=''>

<section class="content-header">
 
      <div class="col-sm-12">
      	<span style="color:white">
        	<b><?=$module?></b>

        		<small>>><?=$lblInput?></small>
        </span>
      </div>
      <!--<div class="col-sm-6">
      		       <a href="#" id="obj_classify" data-toggle='modal' data-target='#modal-input' class="btn btn-success pull-right"><i class="fa fa-search" aria-hidden="true">Classify</i></a>

      </div>-->
      <div class="col-sm-12">&nbsp;
      </div> 


    </section>

       <section class="content container-fluid">
        
         <div class="col-sm-12">
         	 <div class="box box-warning">
			<div class="box-header with-border cols-sm-12" >
					<h3 class="box-title"><b><?=$lblInput?></b></h3>
			</div>
			<label class="col-sm-2">ข้อมูลเนื้อ</label>
			<div class="col-sm-10">
					<select class="form-control" id="obj_Beef"></select>
			</div>
			
		   <div class="col-sm-12"><hr/>
		   </div>

      	 <table width="100%">
      	 	<tr>
      	 		<td >
      	 		<div class="box box-primary">
      	 			 <div  class="col-sm-2" >
      	 			 	<table id="tblBeefList"  class="table table-bordered table-hover" >

      	 			 	</table>
			        </div>
			        <div id="dvRender" class="col-sm-10" >
			            <div style="style:overflow: scroll;min-width: 500px;">
                    	<div id="imgCrop">
                    		<img src="<?=$rootPath?>/IMG/Beef.jpg" width='100%'>
                    	</div>
			            </div>
			        </div>

		        	<div  class="col-sm-4">
		        		<div id="dvClassify">
		        		</div>
		        		<div id="dvJudge"  style="width:100%;display:none">
		        		<table  class="table table-bordered table-hover">
		        			<tr>
		        				<td colspan='2'><label>ตัดเกรด</label>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td width='100px'><label>เกรด</label>
		        				</td>
		        				<td><select id="obj_grade" class="form-control"></select>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td colspan='2'><label>รายละเอียด</label>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td colspan='2'>
		        					<textarea id="obj_description" class="form-control" rows="6" style="width:100%"></textarea>
		        				</td>
		        				
		        			</tr>
		        			<tr>
		        				<td colspan='2' align='center'>
		        					<a class="btn btn-info" id="obj_setgrade"><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp;ตัดเกรด</i></a>
		        				</td>
		        			</tr>
		        		
		        		</table>	
		        		</div>
		        	</div>
		        	

		        	<div id="dvCropInfo" class="col-sm-8">
		        	</div>
			        
			      </div>
      	 		</td>
      	 	</tr>
      	 </table>
		</div>
         </div>
      </section>
</section>

<div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" style="width:850px" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ประเมินเกรดเนื้อ</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>

<link rel="stylesheet" href="jquery.Jcrop.min.css" type="text/css" />
<script src="jquery.min.js"></script>
<script src="jquery.Jcrop.min.js"></script>

<script>
	
	var beefInfos=[];

	

	function listGrade(){
		var url="<?=$rootPath?>/tgrade/getData.php";
		setDDLPrefix(url,"#obj_grade","****เกรดเนื้อ****");
	}

	function listBeef(){
		var url="<?=$rootPath?>/tbeef/listBeef.php";
		setDDLPrefix(url,"#obj_Beef","***เลือกเนื้อ***")
	}

	function setImgList(folder){
		var url="<?=$rootPath?>/tbeefclassify/getImgFromFolder.php?folder="+folder;
		$("#tblBeefList").load(url);
		
	}

	function getImgInfo(folder,file,beefNo){
		$("#dvClassify" ).html("");
		$("#dvClassify").addClass("preLoad");

		var url="<?=$rootPath?>/tbeefclassify/getBeefElementOne.php?folder="+folder+"&file="+file+"&beefNo="+beefNo;
		$("#obj_beefNo").val(beefNo);
		$("#obj_beefCode").val(folder);
		$("#dvClassify").load(url,function() {
  				$("#dvClassify" ).removeClass( "preLoad" );
		});
		


		clearData();
	}	


  function displayImgCrop(folder,picture){
      var url="<?=$rootPath?>/tbeef/displayImgCrop.php?folder="+folder+"&picture="+picture;
      console.log(url);	
      $("#imgCrop").load(url);
  }

  function clearData(){
  	beefInfos=[];
  	$("#dvCropInfo").html("");
  }

   function displayResult(){
   		var beefCode=$("#obj_beefCode").val();
   		var beefNo=$("#obj_beefNo").val();
        var userCode=$("#obj_userCode").val();
   		var url="<?=$rootPath?>/telementtransaction/displayDataByUser.php?beefCode="+beefCode+"&beefNo="+beefNo+"&userCode="+userCode;
        $("#dvCropInfo").load(url);
   }

	function getClassify(imgName,beefNo){
		var url="<?=$picPath?>/"+$("#obj_Beef").val()+"/"+imgName;
		$("#obj_cropImg").attr("src",url);
		getImgInfo($("#obj_Beef").val(),imgName,beefNo);
		getBeefJudge($("#obj_beefCode").val(),$("#obj_beefNo").val(),$("#obj_userCode").val());
		displayImgCrop($("#obj_Beef").val(),imgName);
		displayResult();
		$("#dvJudge").attr("style","display:block");
	}

	function confirmDelete(id){
		swal.fire({
			title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
			text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
			type: "warning",
			confirmButtonText: "ตกลง",
			cancelButtonText: "ยกเลิก",
			showCancelButton: true,
			showConfirmButton: true
		}).then((willDelete) => {
		if (willDelete.value) {
			url="<?=$rootPath?>/telementtransaction/delete.php?id="+id;
			executeGet(url);
			displayResult();
		swal.fire({
			title: "ลบข้อมูลเรียบร้อยแล้ว",
			type: "success",
			buttons: "ตกลง",
		});
		} else {
			swal.fire({
			title: "ยกเลิกการทำรายการ",
			type: "error",
			buttons: [false, "ปิด"],
			dangerMode: true,
		})
		}
		});
	}


	function loadJudge(){
		var url="<?=$rootPath?>/tbeefjudge/input.php";
		$("#dvInputBody").load(url);
	}

	function deleteJudge(){
		var url="<?=$rootPath?>/tbeefjudge/delete.php?beefCode="+$("#obj_beefCode").val()+"&beefNo="+$("#obj_beefNo").val()+"&userCode="+$("#obj_userCode").val();
		var flag=executeGet(url);
		return flag;
	} 
    
	function beefJudge(){
		var url="<?=$rootPath?>/tbeefjudge/create.php";
		var jsonObj={
			judgeCode:$("#obj_userCode").val(),
			beefCode:$("#obj_beefCode").val(),
			beefGrade:$("#obj_grade").val(),
			description:$("#obj_description").val(),
			beefNo:$("#obj_beefNo").val()
		}
		var jsonData=JSON.stringify(jsonObj);
		console.log(jsonData);
		var flag=executeData(url,jsonObj,false);
		return flag;
	}

	function getBeefJudge(beefCode,beefNo,userCode){
		var url="<?=$rootPath?>/tbeefjudge/getData.php?beefCode="+beefCode+"&beefNo="+beefNo+"&userCode="+userCode;
		var data=queryData(url);
		if(data.message===true){
			$("#obj_grade").val(data.beefGrade);
			$("#obj_description").val(data.description);
		}
	}


	$(document).ready(function(){
		listGrade();
		listBeef();
		setImgList("N001");
		loadJudge();

		$("select#obj_Beef").prop('selectedIndex', 1);

		$("#obj_Beef").change(function(){
				setImgList($("#obj_Beef").val());
				
		});

		$("#obj_classify").click(function(){

		});

		$("#obj_setgrade").click(function(){
			var flag=deleteJudge();
			flag= beefJudge();
			if(flag===true){
				swal.fire({
					title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
					type: "success",
					buttons: [false, "ปิด"],
					dangerMode: true,
				}).then((result)=>{
							//getBeefJudge($("#obj_beefCode").val(),$("#obj_beefNo").val(),$("#obj_userCode").val());

				});
			}else{

				swal.fire({
					title: "การบันทึกข้อมูลผิดพลาด",
					type: "error",
					buttons: [false, "ปิด"],
					dangerMode: true,
				});
			}
		});
	});
</script>