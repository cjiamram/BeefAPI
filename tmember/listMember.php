<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tmember.php";
	$database=new Database();
	$db=$database->getConnection();
	$obj=new tmember($db);
	$stmt=$obj->listMember();
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$objItem=array("id"=>$id,
				"memberCode"=>$memberCode,
				"memberName"=>$memberName
				);
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr); 
	}else{
		echo json_encode(array("message"=>false));
	}

?>