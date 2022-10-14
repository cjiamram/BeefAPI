<?php
header("Content-Type: application/json; charset=UTF-8");
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objects/tcow.php";

$config=new Config();
$database=new Database();
$db=$database->getConnection();
$obj=new tcow($db);
$keyWord=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$stmt=$obj->getCowInit($keyWord);
if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array(
					"id"=>$id,
					"cowCode"=>$cowCode,
					"breedType"=>$breedType,
					"cowAge"=>$cowAge,
					"description"=>$description,
					"feedTime"=>$feedTime,
					"memberCode"=>$memberCode
			);

		array_push($objA, $objItem);
		echo json_encode($objArr);
	}
}
else{
		echo json_encode(array("message"=>false));
	}

?>