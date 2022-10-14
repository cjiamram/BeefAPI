<?php
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
		include_once "../config/database.php";
		include_once "../objects/tsite.php";
		include_once "../objects/classLabel.php";
		include_once "../config/config.php";
		$database = new Database();
		$db = $database->getConnection();
		$objLbl = new ClassLabel($db);
		$cnf=new Config();
		$rootPath=$cnf->path;
?>
 <link rel="stylesheet" href="./js/TJQuery/dist/jquery.Thailand.min.css">

<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_site","siteCode","th").":" ?>-<?php echo $objLbl->getLabel("t_site","siteName","th").":" ?></label>
			<div class="col-sm-4">
				<div class="input-group date">
				<input type="text" class="form-control pull-right" id="obj_siteCode">
				<div class="input-group-addon">
				<a id="btnGen" href="#"><i class="fa fa-key" ></i></a>
				</div>
				</div>
			</div>
			<div class="col-sm-8">
				<input type="text" 
							class="form-control" id='obj_siteName' 
							placeholder='siteName'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_site","address","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_address' 
							placeholder='address'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_site","province","th").":" ?>-<?php echo $objLbl->getLabel("t_site","district","th").":" ?></label>
			<div class="col-sm-6">
				<select id="obj_province" class="form-control"></select>
			</div>
			<div class="col-sm-6">
				<select id="obj_district" class="form-control"></select>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_site","postalcode","th").":" ?>-พิกัด(Lat,Lng)</label>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_postalcode' 
							placeholder='postalcode'>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_location' 
							placeholder='Location'>

			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-12"><?php echo $objLbl->getLabel("tsite","photo","th").":" ?></label>
			<div class="col-sm-12">
				<input type="file" 
							class="form-control" id='obj_picture'  onchange="readImg(this);" 
							>

				<input type="hidden" id="obj_file">
			</div>
		</div>
		
		<div class='form-group'>
			<label class="col-sm-12"></label>
			<div class="col-sm-12">
				<div id="dvMap" style="width:750px;height:200px"></div>
			</div>
		</div>
		
</div>
</form>
    <script type="text/javascript" src="./js/TJQuery/dependencies/zip.js/zip.js"></script>
    <script type="text/javascript" src="./js/TJQuery/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="./js/TJQuery/dependencies/typeahead.bundle.js"></script>
    <script type="text/javascript" src="./js/TJQuery/dist/jquery.Thailand.min.js"></script>


<script>
	


	
	
	

	function getMap(){
		var url="<?=$rootPath?>/mapSearch.php";
		$("#dvMap").load(url);
	}


	$(document).ready(function(){
			getMap();
			$("#btnGen").click(function(){
				createCode();
			});

	});
		
	 function readImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){
    	    listProvince();
    		listDistrict($("#obj_province").val());

    		$("#obj_province").change(function(){
    			   listDistrict($("#obj_province").val());

    		});
    });


	
		
</script>
