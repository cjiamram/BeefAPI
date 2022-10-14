<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tbeefjudge.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tbeefjudge($db);
$beefCode=isset($_GET["beefCode"]) ? $_GET["beefCode"] : "";
$beefNo=isset($_GET["beefNo"]) ? $_GET["beefNo"] : "";
$userCode=isset($_GET["userCode"]) ? $_GET["userCode"] : "";

$stmt = $obj->getData($beefCode,$beefNo,$userCode);
$num = $stmt->rowCount();
if($num>0){
			$objArr=array();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$objItem=array(
				"id"=>$id,
				"judgeCode"=>$judgeCode,
				"beefCode"=>$beefCode,
				"beefGrade"=>$beefGrade,
				"createDate"=>$createDate,
				"description"=>$description,
				"message"=>true
			);
			echo json_encode($objItem);
			
}
else{
			echo json_encode(array("message" => false));
}
?>