<?php
include_once "keyWord.php";
class  tpicfoldertest{
	private $conn;
	private $table_name="t_picfoldertest";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $webFolder;
	public $picture;
	public $absoluteFolder;
	public function create(){
		$query='INSERT INTO t_picfoldertest  
        	SET 
			webFolder=:webFolder,
			picture=:picture,
			absoluteFolder=:absoluteFolder
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":webFolder",$this->webFolder);
		$stmt->bindParam(":picture",$this->picture);
		$stmt->bindParam(":absoluteFolder",$this->absoluteFolder);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_picfoldertest 
        	SET 
			webFolder=:webFolder,
			picture=:picture,
			absoluteFolder=:absoluteFolder
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":webFolder",$this->webFolder);
		$stmt->bindParam(":picture",$this->picture);
		$stmt->bindParam(":absoluteFolder",$this->absoluteFolder);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			webFolder,
			picture,
			absoluteFolder
		FROM t_picfoldertest WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	
    public function getClassE($f) {
    	$query="SELECT classStatus FROM t_picfoldertest WHERE picture=:picture";
    	$stmt=$this->conn->prepare($query);
    	$stmt->bindParam(":picture",$f);
    	$stmt->execute();
    	$row=$stmt->fetch(PDO::FETCH_ASSOC);
    	extratc($row);
    	return $classStatus;

    }

	
	public function getImageSize($id,$ratio){
		$fileName="../".$this->getPicture($id);
		list($width, $height)  = getimagesize($fileName);
		return array("width"=>$width,"height"=>$height);

	}

	public function getPicture($id){
		$query="SELECT  
			CONCAT(webFolder,'/',picture) AS pictureVal
		FROM t_picfoldertest 
		WHERE id=:id";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $pictureVal;

	} 

	public function getData(){
		$query="SELECT  
			id,
			id AS code,
			CONCAT(webFolder,'/',picture) AS pictureVal
		FROM t_picfoldertest ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_picfoldertest WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_picfoldertest WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>