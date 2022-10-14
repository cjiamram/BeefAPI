<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once "../config/database.php";
	include_once "../objects/tcow.php";
	include_once "../objects/classLabel.php";
	include_once "../config/config.php";
	$database = new Database();
	$db = $database->getConnection();
	$objLbl = new ClassLabel($db);
	$cnf=new Config();
	$rootPath=$cnf->path;
?>
 <link rel="stylesheet" href="<?=$rootPath?>/bower_components/select2/dist/css/select2.min.css">
<script src="<?=$rootPath?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?=$rootPath?>/bower_components/select2/dist/js/select2.full.min.js"></script>

<form role='form'>
<div class="box-body">
			<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cow","memberCode","th").":" ?></label>
			<div class="col-sm-12">
				<select class="select2" style="width:100%" id='obj_memberCode'></select>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cow","breedType","th").":" ?>/<?php echo $objLbl->getLabel("t_cow","cowAge","th").":" ?></label>
			<div class="col-sm-6">
				
				<select class="form-control" id='obj_breedType'></select>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_cowAge' 
							placeholder='cowAge'>
			</div>
		</div>
	
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cow","description","th").":" ?></label>
			<div class="col-sm-12">
			
				<textarea class="form-control" id='obj_description' 
				rows="4" style="width:100%"
				></textarea>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_cow","feedTime","th").":" ?>/<?php echo $objLbl->getLabel("t_cow","cowWeight","th").":" ?></label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_feedTime' 
							placeholder='feedTime'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_cowWeight' 
							placeholder='cowWeight'>
			</div>
		</div>
</div>
</form>

<script>


  /*$(function () {
    
  });*/
  function listMember(){
  	var url="<?=$rootPath?>/tmember/listMember.php";
  	setDDLPrefix(url,"#obj_memberCode","***เลือกสมาชิก***");
  }

  function listBreedType(){
  	var url="<?=$rootPath?>/tbreedtype/getData.php";
  	setDDL(url,"#obj_breedType");
  }

  $(document).ready(function(){
  	$('#obj_memberCode').select2()
  	listMember();
  	listBreedType();
  });

</script>

