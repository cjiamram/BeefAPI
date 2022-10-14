 <?php
 	include_once "../config/config.php";
 	include_once "../config/database.php";	
 	include_once "../objects/tpicfoldertest.php";

 	$cnf=new Config();
 	$rootPath=$cnf->path;

 	$database=new Database();
 	$db=$database->getConnection();
 	$obj=new tpicfoldertest($db);
 	$id=isset($_GET["id"])?$_GET["id"]:0;

 	$picture=$obj->getPicture($id)

 	echo  '<img src="'$rootPath."/".$picture.'" id="cropbox" style="width:100%"  />';

 ?>       
