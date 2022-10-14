<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tclassifytransaction.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tclassifytransaction($db);
	$beefCode=isset($_GET["beefCode"])?$_GET["beefCode"]:"";
	$beefNo=isset($_GET["beefNo"])?$_GET["beefNo"]:"";

	$id=$obj->getId($beefCode);

	echo json_encode(array("id"=>$id));


?>