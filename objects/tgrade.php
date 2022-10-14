<?php
include_once "keyWord.php";
class  tgrade{
	private $conn;
	private $table_name="t_grade";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $weight;
	public function create(){
		$query='INSERT INTO t_grade  
        	SET 
			code=:code,
			weight=:weight
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":weight",$this->weight);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_grade 
        	SET 
			code=:code,
			weight=:weight
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":weight",$this->weight);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getGrade($code){
		$query="SELECT  id,
			code,
			weight
		FROM t_grade WHERE code=:code";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':code',$code);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $weight; 
		}
		return "";
		
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			weight
		FROM t_grade WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){

		$query="SELECT  id,
			code,
			weight
		FROM t_grade ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_grade WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_grade WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>