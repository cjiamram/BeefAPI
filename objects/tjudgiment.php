<?php
include_once "keyWord.php";
class  tjudgiment{
	private $conn;
	private $table_name="t_judgiment";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $judgimentGrade;
	public $averageWeight;
	public $description;
	public $createDate;
	public $cowCode;
	public function create(){
		$query='INSERT INTO t_judgiment  
        	SET 
			userCode=:userCode,
			judgimentGrade=:judgimentGrade,
			averageWeight=:averageWeight,
			description=:description,
			createDate=:createDate,
			cowCode=:cowCode
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":judgimentGrade",$this->judgimentGrade);
		$stmt->bindParam(":averageWeight",$this->averageWeight);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_judgiment 
        	SET 
			userCode=:userCode,
			judgimentGrade=:judgimentGrade,
			averageWeight=:averageWeight,
			description=:description,
			createDate=:createDate,
			cowCode=:cowCode
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":judgimentGrade",$this->judgimentGrade);
		$stmt->bindParam(":averageWeight",$this->averageWeight);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			judgimentGrade,
			averageWeight,
			description,
			createDate,
			cowCode
		FROM t_judgiment WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$query='SELECT  id,
			userCode,
			judgimentGrade,
			averageWeight,
			description,
			createDate,
			cowCode
		FROM t_judgiment WHERE userCode LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_judgiment WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_judgiment WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>