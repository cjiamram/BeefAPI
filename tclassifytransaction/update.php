<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tclassifytransaction.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tclassifytransaction($db);
$data = json_decode(file_get_contents("php://input"));
$obj->beefCode = $data->beefCode;
$obj->accuracy = $data->accuracy;

$obj->beefNo = $data->beefNo;
$obj->grade = $data->grade;
$obj->fat = $data->fat;
$obj->beef = $data->beef;
$obj->ratio = $data->ratio;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>