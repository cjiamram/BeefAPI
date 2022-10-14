<?php
	header("content-type:application/json; charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tpicfoldertest.php";

	$f=isset($_GET["f"])?$_GET["f"]:"";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tpicfoldertest($db);
	echo json_encode(array("classStatus"=>$obj->getClassE($f)));
?>