<?php
include_once "keyWord.php";
class  tclassifytransaction{
	private $conn;
	private $table_name="t_classifytransaction";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $beefCode;
	public $beefNo;
	public $grade;
	public $fat;
	public $beef;
	public $ratio;
	public $accuracy;
	public $fraction;
	public function create(){
		$query='INSERT INTO t_classifytransaction  
        	SET 
			beefCode=:beefCode,
			beefNo=:beefNo,
			grade=:grade,
			fat=:fat,
			beef=:beef,
			ratio=:ratio,
			accuracy=:accuracy,
			fraction=:fraction
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$stmt->bindParam(":grade",$this->grade);
		$stmt->bindParam(":fat",$this->fat);
		$stmt->bindParam(":beef",$this->beef);
		$stmt->bindParam(":ratio",$this->ratio);
		$stmt->bindParam(":accuracy",$this->accuracy);
		$stmt->bindParam(":fraction",$this->fraction);

		$flag=$stmt->execute();
		return $flag;
	}


	public function update(){
		$query='UPDATE t_classifytransaction 
        	SET 
			beefCode=:beefCode,
			beefNo=:beefNo,
			grade=:grade,
			fat=:fat,
			beef=:beef,
			ratio=:ratio,
			accuracy=:accuracy
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":beefNo",$this->beefNo);
		$stmt->bindParam(":grade",$this->grade);
		$stmt->bindParam(":fat",$this->fat);
		$stmt->bindParam(":beef",$this->beef);
		$stmt->bindParam(":ratio",$this->ratio);
		$stmt->bindParam(":accuracy",$this->accuracy);

		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getId($beefCode,$beefNo){
		$query="SELECT id 
			FROM t_classifytransaction 
			WHERE beefCode=:beefCode 
			AND beefNo=:beefNo
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":beefCode",$beefCode);
		$stmt->bindParam(":beefNo",$beefNo);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $id; 
		}
		return 0;

	}


	public function readOne(){
		$query='SELECT  id,
			beefCode,
			beefNo,
			grade,
			fat,
			beef,
			ratio
		FROM t_classifytransaction WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getDataByCode($beefCode,$beefNo){
		$query="SELECT  id,
			beefCode,
			beefNo,
			accuracy,
			grade,
			fat,
			beef,
			ratio
		FROM t_classifytransaction 
		WHERE beefCode=:beefCode
		AND beefNo=:beefNo
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':beefCode',$beefCode);
		$stmt->bindParam(':beefNo',$beefNo);
		$stmt->execute();
		return $stmt;
	}

	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			beefCode,
			beefNo,
			grade,
			fat,
			beef,
			ratio
		FROM t_classifytransaction WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_classifytransaction WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_classifytransaction WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>