<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tmember.php";
include_once "../objects/manage.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tmember($db);
$data = json_decode(file_get_contents("php://input"));
$obj->memberCode = $data->memberCode;
$obj->memberName = $data->memberName;
$obj->profile = $data->profile;
$obj->homeNo = $data->homeNo;
$obj->moo = $data->moo;
$obj->tumbol = $data->tumbol;
$obj->district = $data->district;
$obj->province = $data->province;
$obj->postalCode = $data->postalCode;
$obj->telNo = $data->telNo;
$obj->email = $data->email;
$obj->lineId = $data->lineId;
$obj->faceBook = $data->faceBook;
$obj->location = $data->location;
$obj->status = $data->status;
$obj->createDate = $data->createDate;
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>