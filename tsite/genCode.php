<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/tsite.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tsite($db);
	$MXCode=$obj->genCode();
	echo json_encode(array("MXCode"=>$MXCode));

?>