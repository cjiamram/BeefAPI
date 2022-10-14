<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/telementtransaction.php";
$database = new Database();
$db = $database->getConnection();
$obj = new telementtransaction($db);
$data = json_decode(file_get_contents("php://input"));
$obj->fat = $data->fat;
$obj->beef = $data->beef;
$obj->ratio = $data->ratio;
$obj->beefCode = $data->beefCode;
$obj->beefNo = $data->beefNo;
$obj->square = $data->square;
$obj->fraction = $data->fraction;
$obj->userCode=$data->userCode;
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>