<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tjudgiment.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tjudgiment($db);
$data = json_decode(file_get_contents("php://input"));
$obj->id = isset($_GET['id']) ? $_GET['id'] : 0;
$stmt=$obj->readOne();
$num=$stmt->rowCount();
if($num>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$item = array(
			"id"=>$id,
			"userCode" =>  $userCode,
			"judgimentGrade" =>  $judgimentGrade,
			"averageWeight" =>  $averageWeight,
			"description" =>  $description,
			"createDate" =>  $createDate,
			"cowCode" =>  $cowCode
		);
}
echo(json_encode($item));
?>