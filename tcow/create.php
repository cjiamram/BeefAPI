<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tcow.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tcow($db);
$data = json_decode(file_get_contents("php://input"));
$obj->cowCode = $obj->genCode();
$obj->breedType = $data->breedType;
$obj->cowAge = $data->cowAge;
$obj->description = $data->description;
$obj->feedTime = $data->feedTime;
$obj->createDate = date("Y-m-d");
$obj->memberCode = $data->memberCode;
/*$obj->busheryDate = $data->busheryDate;
$obj->cowWeight = $data->cowWeight;
$obj->dryAge = $data->dryAge;
$obj->coldWeight = $data->coldWeight;
$obj->warmWeight = $data->warmWeight;
$obj->classifyWeight = $data->classifyWeight;*/
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>