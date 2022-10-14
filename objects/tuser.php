<?php
include_once "keyWord.php";
class  tuser{
	private $conn;
	private $table_name="t_user";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $UserName;
	public $Password;
	public $FullName;
	public $Picture;
	public $UserCode;
	public $DepartmentId;
	public $position;
	public $telNo;
	public $email;
	public $lineNo;
	public $facebook;
	public function create(){
		$query='INSERT INTO t_user  
        	SET 
			UserName=:UserName,
			FullName=:FullName,
			Password=:Password,
			Picture=:Picture,
			UserCode=:UserName,
			DepartmentId=:DepartmentId,
			position=:position,
			telNo=:telNo,
			email=:email,
			lineNo=:lineNo,
			facebook=:facebook
	';
		$stmt = $this->conn->prepare($query);
		//print_r($this->Password);

		$stmt->bindParam(":UserName",$this->UserName);
		$stmt->bindParam(":Password",$this->Password);
		$stmt->bindParam(":FullName",$this->FullName);
		$stmt->bindParam(":Picture",$this->Picture);
		$stmt->bindParam(":DepartmentId",$this->DepartmentId);
		$stmt->bindParam(":position",$this->position);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":facebook",$this->facebook);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_user 
        	SET 
			UserName=:UserName,
			Password=:Password,
			FullName=:FullName,
			Picture=:Picture,
			UserCode=:UserCode,
			DepartmentId=:DepartmentId,
			position=:position,
			telNo=:telNo,
			email=:email,
			lineNo=:lineNo,
			facebook=:facebook
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":UserName",$this->UserName);
		$stmt->bindParam(":Password",$this->Password);
		$stmt->bindParam(":FullName",$this->FullName);
		$stmt->bindParam(":Picture",$this->Picture);
		$stmt->bindParam(":UserCode",$this->UserCode);
		$stmt->bindParam(":DepartmentId",$this->DepartmentId);
		$stmt->bindParam(":position",$this->position);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":facebook",$this->facebook);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			UserName,
			Password,
			FullName,
			Picture,
			UserCode,
			DepartmentId,
			position,
			telNo,
			email AS email,
			lineNo,
			facebook
		FROM t_user WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function readByUserName($userName){
		$query='SELECT  
			id,
			UserName,
			Password,
			FullName,
			Picture,
			UserCode,
			DepartmentId,
			position,
			telNo,
			email,
			lineNo,
			facebook
		FROM t_user WHERE UserName=:userName';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':userName',$userName);
		$stmt->execute();
		return $stmt;
	}

	public function getUserExist($userName){
		$query="SELECT id FROM t_user 
		WHERE UserName=:userName";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userName",$userName);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return true;
		else
			return false;

	}

	public function getData($keyWord){
	
		$query='SELECT  A.id,
			A.UserName,
			A.Password,
			A.FullName,
			A.Picture,
			B.departmentName AS DepartmentId,
			A.position,
			A.telNo,
			A.email,
			A.lineNo,
			A.facebook
		FROM t_user A LEFT OUTER JOIN t_department B 
		ON A.DepartmentId=B.deparmentCode
		WHERE 
		A.FullName LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_user WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_user WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>