<?php
include_once "keyWord.php";
class  tbeef{
	private $conn;
	private $table_name="t_beef";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $beefFolder;
	public $beefCode;
	public $status;
	public $classifyJudge;
	public $createDate;
	public function getFolderExist($beefFolder){
		$query="SELECT id FROM t_beef WHERE beefFolder=:beefFolder";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":beefFolder",$beefFolder);
		$stmt->execute();
		if($stmt->rowCount()>0){
			return true;
		} return false;
	}

	public function create(){
		$query='INSERT INTO t_beef  
        	SET 
			beefFolder=:beefFolder,
			beefCode=:beefCode,
			status=:status,
			classifyJudge=:classifyJudge,
			createDate=:createDate
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefFolder",$this->beefFolder);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":classifyJudge",$this->classifyJudge);
		$stmt->bindParam(":createDate",$this->createDate);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_beef 
        	SET 
			beefFolder=:beefFolder,
			beefCode=:beefCode,
			status=:status,
			classifyJudge=:classifyJudge,
			createDate=:createDate
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":beefFolder",$this->beefFolder);
		$stmt->bindParam(":beefCode",$this->beefCode);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":classifyJudge",$this->classifyJudge);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			beefFolder,
			beefCode,
			status,
			classifyJudge,
			createDate
		FROM t_beef WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
	
		$query='SELECT  id,
			beefFolder,
			beefCode,
			status,
			classifyJudge,
			createDate
		FROM t_beef WHERE status=0';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getImageSize($picture){
		$fileName=$picture;
		list($width, $height)  = getimagesize($fileName);
		return array("width"=>$width,"height"=>$height);

	}


	public function listBeef(){
	
		$query='SELECT  id,
			beefFolder,
			beefCode

		FROM t_beef WHERE status=0';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_beef WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_beef WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>