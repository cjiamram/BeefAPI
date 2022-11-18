<?php
include_once "keyWord.php";
class  tbeefjudge{
	private $conn;
	private $table_name="t_beefjudge";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $judgeCode;
	public $beefCode;
	public $beefGrade;
	public $createDate;
	public $description;
	public $beefNo;
	public $userCode;
	
	public function userMapping($userCode,$id){
		$query="UPDATE t_beefjudge SET userCode=:userCode WHERE id=:id";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->bindParam(":id",$id);
		$flag=$stmt->execute();
		return $flag; 	
	}

	public function setCloseStatus($id){
		$query="UPDATE t_beefjudge SET status=1 WHERE id=:id";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function create(){
		$query="INSERT INTO t_beefjudge  
        	SET 
			judgeCode=:judgeCode,
			beefCode=:beefCode,
			beefGrade=:beefGrade,
			createDate=:createDate,
			description=:description,
			beefNo=:beefNo";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":judgeCode",$this->judgeCode);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefGrade",$this->beefGrade);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query="UPDATE t_beefjudge 
        	SET 
			judgeCode=:judgeCode,
			beefCode=:beefCode,
			beefGrade=:beefGrade,
			createDate=:createDate,
			description=:description,
			beefNo=:beefNo
		 WHERE id=:id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":judgeCode",$this->judgeCode);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefGrade",$this->beefGrade);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			judgeCode,
			beefCode,
			beefGrade,
			createDate,
			description,
			beefNo
		FROM t_beefjudge WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($beefCode,$beefNo,$userCode){

		$query="SELECT  id,
			judgeCode,
			beefCode,
			beefGrade,
			createDate,
			description,
			beefNo
		FROM t_beefjudge 
		WHERE 
			beefCode=:beefCode 
		AND
			beefNo=:beefNo
		AND
			judgeCode=:userCode  ";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->bindParam(':userCode',$userCode);
		$stmt->execute();
		return $stmt;
	}


	function delete($beefCode,$beefNo,$userCode){
		$query="DELETE FROM t_beefjudge 
		WHERE 
			beefCode=:beefCode 
		AND
			beefNo=:beefNo
		AND
			judgeCode=:userCode  
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->bindParam(':userCode',$userCode);
		$flag=$stmt->execute();
		return $flag;
	}
	public function genCode(){
		$curYear = date("Y")-2000+543;
		$curYear = substr($curYear,1,2);
		$curYear = sprintf("%02d", $curYear);
		$curMonth=date("n");
		$curMonth = sprintf("%02d",$curMonth);
		$prefix= $curYear .$curMonth;
		$query ="SELECT MAX(CODE) AS MXCode FROM t_beefjudge WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>