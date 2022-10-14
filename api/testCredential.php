<?php
header("Content-Type: application/json; charset=UTF-8");
	require_once("../lib/nusoap.php");
	header ("Content-Type: text/html; charset=utf-8");

	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_userLogin.php?wsdl",true);
	$params = array(
		'userlogin' =>"watchapol.p",
		'password' => "watchapol.p"
	);
	$data = $client->call("getUserLogin",$params); 
	$student = json_decode($data,true);


	//echo 'student : ' . $student . '<br><br>';
	if($data!=""){
		echo  json_encode($data);
	}
	
	
?>