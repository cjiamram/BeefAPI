<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/telementtransaction.php";
	$database=new Database();
	$db=$database->getConnection();
	$obj=new telementtransaction($db);
	$beefCode=isset($_GET["beefCode"])?$_GET["beefCode"]:"";
	$beefNo=isset($_GET["beefNo"])?$_GET["beefNo"]:0;
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

	$cnt=$obj->getCountFraction($beefCode,$beefNo,$userCode);
	echo json_encode(array("cnt"=>$cnt));
?>