<?php
include_once "keyWord.php";
class  tjudgement{
	private $conn;
	private $table_name="t_judgement";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $judgeName;
	public $description;
	public function create(){
		$query='INSERT INTO t_judgement  
        	SET 
			judgeName=:judgeName,
			description=:description
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":judgeName",$this->judgeName);
		$stmt->bindParam(":description",$this->description);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_judgement 
        	SET 
			judgeName=:judgeName,
			description=:description
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":judgeName",$this->judgeName);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			judgeName,
			description
		FROM t_judgement WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			judgeName,
			description
		FROM t_judgement WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_judgement WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_judgement WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>