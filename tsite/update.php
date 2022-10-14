<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tsite.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tsite($db);
$data = json_decode(file_get_contents("php://input"));
$obj->siteCode = $data->siteCode;
$obj->siteName = $data->siteName;
$obj->address = $data->address;
$obj->district = $data->district;
$obj->province = $data->province;
$obj->postalcode = $data->postalcode;
$obj->lat = $data->lat;
$obj->lng = $data->lng;
$obj->photo = $data->photo;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>