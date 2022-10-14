 <?php
	header("content-type:html/text;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../config/database.php";	

	$cnf=new Config();
	$rootPath=$cnf->path;
	$aiURL=$cnf->deepURL;
	$database=new Database();
	$db=$database->getConnection();
	$obj=new tpicfoldertest($db);
	$id=isset($_GET["id"])?$_GET["id"]:0;

	$picture=$rootPath."/".$obj->getPicture($id);
	$size=$obj->getImageSize($id,1);
	$sizeStyle="width:".$size["width"]."px;height:".$size["height"]."px";
	$sizeW=$size["width"];
	$sizeH=$size["height"];
	//print_r($picture);
	echo '<input type="hidden" id="hdn_picture" value="'.$picture.'">';
 ?>