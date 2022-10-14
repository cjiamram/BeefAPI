<?php
	header("content-type:application/json; charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tpicfoldertest.php";

	$id=isset($_GET["id"])?$_GET["id"]:0;

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tpicfoldertest($db);
	echo json_encode(array("pictureVal"=>$obj->getPicture($id)));
?>