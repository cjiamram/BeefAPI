<?php
include_once "keyWord.php";
class  telementtransaction{
	private $conn;
	private $table_name="t_elementtransaction";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $fat;
	public $beef;
	public $ratio;
	public $beefCode;
	public $beefNo;
	public $square;
	public $fraction;
	public $userCode;
	

	public function create(){
		//print_r($this->fraction);
		$query='INSERT INTO t_elementtransaction  
        	SET 
			fat=:fat,
			beef=:beef,
			ratio=:ratio,
			beefCode=:beefCode,
			beefNo=:beefNo,
			square=:square,
			fraction=:fraction,
			userCode=:userCode
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":fat",$this->fat);
		$stmt->bindParam(":beef",$this->beef);
		$stmt->bindParam(":ratio",$this->ratio);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$stmt->bindParam(":square",$this->square);
		$stmt->bindParam(":fraction",$this->fraction);
		$stmt->bindParam(":userCode",$this->userCode);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_elementtransaction 
        	SET 
			fat=:fat,
			beef=:beef,
			ratio=:ratio,
			beefCode=:beefCode,
			beefNo=:beefNo
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":fat",$this->fat);
		$stmt->bindParam(":beef",$this->beef);
		$stmt->bindParam(":ratio",$this->ratio);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			fat,
			beef,
			ratio,
			beefCode,
			beefNo 
		FROM t_elementtransaction WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($beefCode,$beefNo){
		$query="SELECT  
			id,
			fat,
			beef,
			ratio,
			beefCode,
			square,
			fraction,
			userCode
		FROM t_elementtransaction 
		WHERE 
		beefCode=:beefCode 
		AND 
		beefNo=:beefNo
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->execute();
		return $stmt;
	}

	public function getCountFraction($beefCode,$beefNo,$userCode){
		$query="SELECT  
			COUNT(id) AS CNT
			
		FROM t_elementtransaction 
		WHERE 
			beefCode=:beefCode 
		AND 
			beefNo=:beefNo
		AND 
			userCode=:userCode
		";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->bindParam(':userCode',$userCode);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return intval($CNT); 
		}
		return 0;
	}

	public function getDataByUser($beefCode,$beefNo,$userCode){
		$query="SELECT  
			id,
			fat,
			beef,
			ratio,
			beefCode,
			square,
			fraction,
			userCode
		FROM t_elementtransaction 
		WHERE 
			beefCode=:beefCode 
		AND 
			beefNo=:beefNo
		AND 
			userCode=:userCode
		";

		//print_r($userCode);
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->bindParam(':userCode',$userCode);
		$stmt->execute();
		return $stmt;
	}


	function delete(){
		$query='DELETE FROM t_elementtransaction WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_elementtransaction WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>