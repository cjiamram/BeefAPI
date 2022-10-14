<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tmember.php";
include_once "../objects/classLabel.php";
include_once "../config/config.php";
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$rootPath=$cnf->path;
?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","memberCode","th").":" ?>/<?php echo $objLbl->getLabel("t_member","memberName","th").":" ?></label>
			<div class="col-sm-4">
				<input type="text" 
							class="form-control" id='obj_memberCode' 
							placeholder='memberCode'>
			</div>
			<div class="col-sm-8">
				<input type="text" 
							class="form-control" id='obj_memberName' 
							placeholder='memberName'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","profile","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_profile' 
							placeholder='profile'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","homeNo","th").":" ?>/<?php echo $objLbl->getLabel("t_member","moo","th").":" ?>/<?php echo $objLbl->getLabel("t_member","tumbol","th").":" ?></label>
			<div class="col-sm-2">
				<input type="text" 
							class="form-control" id='obj_homeNo' 
							placeholder='homeNo'>
			</div>
			<div class="col-sm-2">
				<input type="text" 
							class="form-control" id='obj_moo' 
							placeholder='moo'>
			</div>
			<div class="col-sm-8">
				<input type="text" 
							class="form-control" id='obj_tumbol' 
							placeholder='tumbol'>
			</div>
		</div>
		
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","province","th").":" ?>/<?php echo $objLbl->getLabel("t_member","district","th").":" ?></label>
			<div class="col-sm-6">
				<select class="form-control" id='obj_province'></select>
			</div>
			<div class="col-sm-6">
				<select class="form-control" id='obj_district'></select>
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","postalCode","th").":" ?>/<?php echo $objLbl->getLabel("t_member","telNo","th").":" ?></label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_postalCode' 
							placeholder='postalCode'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_telNo' 
							placeholder='telNo'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","email","th").":" ?>/<?php echo $objLbl->getLabel("t_member","lineId","th").":" ?></label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_email' 
							placeholder='email'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_lineId' 
							placeholder='lineId'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","faceBook","th").":" ?>/<?php echo $objLbl->getLabel("t_member","location","th").":" ?></label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_faceBook' 
							placeholder='faceBook'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_location' 
							placeholder='location'>
			</div>
		</div>
		
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_member","createDate","th").":" ?></label>
			<div class="col-sm-4">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" class="form-control" id="obj_createDate">
				</div>
			</div>
		</div>
</div>
</form>

<script>
function listProvince(){
	var url="<?=$rootPath?>/province/listData.php";
	setDDLPrefix(url,"#obj_province","***จังหวัด***");
}

function listDistrict(province){
	var url="<?=$rootPath?>/district/listData.php?province="+province;
	setDDLPrefix(url,"#obj_district","***อำเภอ***");
}


$(document).ready(function(){
	listProvince();
	listDistrict($("#obj_province").val());

	$("#obj_province").change(function(){
		listDistrict($("#obj_province").val());
	});
});
</script>
