<?php
	header("content-type:application/json;charset=UTF-8");
	ob_start();
	$fat=isset($_GET["fat"])?$_GET["fat"]:0;
	$beef=isset($_GET["beef"])?$_GET["beef"]:1;
	passthru('python3 getFraction.py '.$fat.' '.$beef);
	$output = ob_get_clean();
	//print_r(array("frac"$output)); 

	$jsonObj=array("fraction"=> str_replace('\\r\\n','', $output));
	echo json_encode($jsonObj);

?>