<?php
	header("content-typeb:application/json;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/tmember.php";

	$cnf=new Config();
	$rootPath=$cnf->path;
	$database=new Database();
	$db=$database->getConnection();
	$obj=new tmember($db);
	$memberCode=isset($_GET["memberCode"])?$_GET["memberCode"]:"";
	$flag=$obj->isMemberExist($memberCode);
	echo json_encode(array("flag"=>$flag));


?>