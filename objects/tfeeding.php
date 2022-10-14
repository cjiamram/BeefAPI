<?php
include_once "keyWord.php";
class  tfeeding{
	private $conn;
	private $table_name="t_feeding";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $cowCode;
	public $food;
	public $cowAge;
	public $createDate;
	public $qty;
	public function create(){
		$query='INSERT INTO t_feeding  
        	SET 
			cowCode=:cowCode,
			food=:food,
			cowAge=:cowAge,
			createDate=:createDate,
			qty=:qty
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$stmt->bindParam(":food",$this->food);
		$stmt->bindParam(":cowAge",$this->cowAge);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":qty",$this->qty);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_feeding 
        	SET 
			cowCode=:cowCode,
			food=:food,
			cowAge=:cowAge,
			createDate=:createDate,
			qty=:qty
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":cowCode",$this->cowCode);
		$stmt->bindParam(":food",$this->food);
		$stmt->bindParam(":cowAge",$this->cowAge);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":qty",$this->qty);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			cowCode,
			food,
			cowAge,
			createDate,
			qty
		FROM t_feeding WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			cowCode,
			food,
			cowAge,
			createDate,
			qty
		FROM t_feeding WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_feeding WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_feeding WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>