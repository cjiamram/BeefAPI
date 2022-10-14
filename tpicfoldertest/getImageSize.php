<?php
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objects/tpicfoldertest.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tpicfoldertest($db);
$id=isset($_GET["id"])?$_GET["id"]:0;
$decRatio=isset($_GET["ratio"])?$_GET["ratio"]:1;

$fileName=$obj->getPicture($id); 
list($width, $height)  = getimagesize($fileName);
echo json_encode(array("width"=>$width/$decRatio,"height"=>$height/$decRatio));
?>