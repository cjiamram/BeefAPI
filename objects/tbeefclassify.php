<?php
include_once "keyWord.php";
class  tbeefclassify{
	private $conn;
	private $table_name="t_beefclassify";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $beefCode;
	public $userCode;
	public $scanType;
	public $segmentArea;
	public $classifyGrade;
	public $classifyWeight;
	public $beefRatio;
	public $fatRatio;
	public $createDate;
	public function create(){
		$query='INSERT INTO t_beefclassify  
        	SET 
			beefCode=:beefCode,
			userCode=:userCode,
			scanType=:scanType,
			segmentArea=:segmentArea,
			classifyGrade=:classifyGrade,
			classifyWeight=:classifyWeight,
			beefRatio=:beefRatio,
			fatRatio=:fatRatio,
			createDate=:createDate
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":scanType",$this->scanType);
		$stmt->bindParam(":segmentArea",$this->segmentArea);
		$stmt->bindParam(":classifyGrade",$this->classifyGrade);
		$stmt->bindParam(":classifyWeight",$this->classifyWeight);
		$stmt->bindParam(":beefRatio",$this->beefRatio);
		$stmt->bindParam(":fatRatio",$this->fatRatio);
		$stmt->bindParam(":createDate",$this->createDate);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_beefclassify 
        	SET 
			beefCode=:beefCode,
			userCode=:userCode,
			scanType=:scanType,
			segmentArea=:segmentArea,
			classifyGrade=:classifyGrade,
			classifyWeight=:classifyWeight,
			beefRatio=:beefRatio,
			fatRatio=:fatRatio,
			createDate=:createDate
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":scanType",$this->scanType);
		$stmt->bindParam(":segmentArea",$this->segmentArea);
		$stmt->bindParam(":classifyGrade",$this->classifyGrade);
		$stmt->bindParam(":classifyWeight",$this->classifyWeight);
		$stmt->bindParam(":beefRatio",$this->beefRatio);
		$stmt->bindParam(":fatRatio",$this->fatRatio);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			beefCode,
			userCode,
			scanType,
			segmentArea,
			classifyGrade,
			classifyWeight,
			beefRatio,
			fatRatio,
			createDate
		FROM t_beefclassify WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			beefCode,
			userCode,
			scanType,
			segmentArea,
			classifyGrade,
			classifyWeight,
			beefRatio,
			fatRatio,
			createDate
		FROM t_beefclassify WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_beefclassify WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_beefclassify WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>