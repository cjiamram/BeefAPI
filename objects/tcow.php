<?php
include_once "keyWord.php";
class  tcow{
	private $conn;
	private $table_name="t_cow";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $cowCode;
	public $breedType;
	public $cowAge;
	public $description;
	public $feedTime;
	public $createDate;
	public $memberCode;
	public $busheryDate;
	public $cowWeight;
	public $dryAge;
	public $coldWeight;
	public $warmWeight;
	public $classifyWeight;
	
	public function createInitialize(){
		$query="INSERT INTO t_cow  
        	SET 
			cowCode=:cowCode,
			breedType=:breedType,
			cowAge=:cowAge,
			description=:description,
			feedTime=:feedTime,
			createDate=:createDate";
	}

	public function create(){
		$query="INSERT INTO t_cow  
        	SET 
			cowCode=:cowCode,
			breedType=:breedType,
			cowAge=:cowAge,
			description=:description,
			feedTime=:feedTime,
			createDate=:createDate";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$stmt->bindParam(":breedType",$this->breedType);
		$stmt->bindParam(":cowAge",$this->cowAge);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":feedTime",$this->feedTime);
		$stmt->bindParam(":createDate",$this->createDate);
		
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_cow 
        	SET 
			cowCode=:cowCode,
			breedType=:breedType,
			cowAge=:cowAge,
			description=:description,
			feedTime=:feedTime,
			createDate=:createDate,
			memberCode=:memberCode,
			busheryDate=:busheryDate,
			cowWeight=:cowWeight,
			dryAge=:dryAge,
			coldWeight=:coldWeight,
			warmWeight=:warmWeight,
			classifyWeight=:classifyWeight
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$stmt->bindParam(":breedType",$this->breedType);
		$stmt->bindParam(":cowAge",$this->cowAge);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":feedTime",$this->feedTime);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":memberCode",$this->memberCode);
		$stmt->bindParam(":busheryDate",$this->busheryDate);
		$stmt->bindParam(":cowWeight",$this->cowWeight);
		$stmt->bindParam(":dryAge",$this->dryAge);
		$stmt->bindParam(":coldWeight",$this->coldWeight);
		$stmt->bindParam(":warmWeight",$this->warmWeight);
		$stmt->bindParam(":classifyWeight",$this->classifyWeight);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			cowCode,
			breedType,
			cowAge,
			description,
			feedTime,
			createDate,
			memberCode,
			busheryDate,
			cowWeight,
			dryAge,
			coldWeight,
			warmWeight,
			classifyWeight
		FROM t_cow WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getCowInit($keyWord){

		$query="SELECT  
			A.id,
			A.cowCode,
			B.breedType,
			A.cowAge,
			A.description,
			A.feedTime,
			A.createDate,
			A.memberCode,
			C.memberName
			
		FROM t_cow A 
		LEFT OUTER JOIN t_breedtype  B
		ON A.breedType=B.code 
		LEFT OUTER JOIN t_member C
		ON A.memberCode=C.memberCode
		WHERE CONCAT(A.memberCode,C.memberName) 
		LIKE :keyWord 
		ORDER BY A.createDate DESC
		";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}


	public function getData($memberCode){

		$query='SELECT  id,
			cowCode,
			breedType,
			cowAge,
			description,
			feedTime,
			createDate,
			memberCode,
			busheryDate,
			cowWeight,
			dryAge,
			coldWeight,
			warmWeight,
			classifyWeight
		FROM t_cow WHERE memberCode LIKE :memberCode';
		$stmt = $this->conn->prepare($query);
		$memberCode="%{$memberCode}%";
		$stmt->bindParam(':memberCode',$memberCode);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_cow WHERE id=:id';
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
		$p=$prefix;
		$query ="SELECT MAX(cowCode) AS MXCode FROM t_cow WHERE cowCode LIKE ?";
		$stmt = $this->conn->prepare($query);
		$p="{$prefix}%";
		$stmt->bindParam(1, $p);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($MXCode);
			$res = Format::getLengthFormat(intval(substr($MXCode, 5, 4))+1,4); 
			$MXCode=$prefix.$res;
		}
		return $stmt;
	}
}

?>