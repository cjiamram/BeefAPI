<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";

	$cnf=new Config();
	$api=new ClassAPI();

	$url=$cnf->path."tclassifytransaction/getDataByCode.php?beefCode=".$beefCode."&beefNo=".$beefNo;
	$data=$api->getAPI($url);
	if(!isset($data["message"])){
		echo "<table style='width:100%'>\n";
		echo "<tr><td width='150px'></td><td></td></tr>\n";
		echo "</table>\n"
	}
?>

