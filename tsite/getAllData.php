<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/tsite.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsite($db);

	$stmt=$obj->getAllData();

	if($stmt->rowCount()>0){
		$objArr=array();	

		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){			
			extract($row);
			$objItem=array(
					"id"=>$id,
					"siteCode"=>$siteCode,
					"siteName"=>$siteName,
					"address"=>$address,
					"district"=>$district,
					"province"=>$province,
					"lat"=>floatval($lat),
					"lng"=>floatval($lng),
					"postalcode"=>$postalcode,
					"photo"=>$photo
			);
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr);
	}


?>