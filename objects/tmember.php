<?php
include_once "keyWord.php";
class  tmember{
	private $conn;
	private $table_name="t_member";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $memberCode;
	public $memberName;
	public $profile;
	public $homeNo;
	public $moo;
	public $tumbol;
	public $district;
	public $province;
	public $postalCode;
	public $telNo;
	public $email;
	public $lineId;
	public $faceBook;
	public $location;
	public $status;
	public $createDate;


	public function isMemberExist($memberCode){
		$query="SELECT memberCode 
		FROM t_member 
		WHERE memberCode=:memberCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":memberCode",$memberCode);
		$stmt->execute();
		if($stmt->rowCount()>0)
			return true;
		else
			return false;
	}


	public function create(){
		$query='INSERT INTO t_member  
        	SET 
			memberCode=:memberCode,
			memberName=:memberName,
			profile=:profile,
			homeNo=:homeNo,
			moo=:moo,
			tumbol=:tumbol,
			district=:district,
			province=:province,
			postalCode=:postalCode,
			telNo=:telNo,
			email=:email,
			lineId=:lineId,
			faceBook=:faceBook,
			location=:location,
			status=:status,
			createDate=:createDate
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":memberCode",$this->memberCode);
		$stmt->bindParam(":memberName",$this->memberName);
		$stmt->bindParam(":profile",$this->profile);
		$stmt->bindParam(":homeNo",$this->homeNo);
		$stmt->bindParam(":moo",$this->moo);
		$stmt->bindParam(":tumbol",$this->tumbol);
		$stmt->bindParam(":district",$this->district);
		$stmt->bindParam(":province",$this->province);
		$stmt->bindParam(":postalCode",$this->postalCode);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":lineId",$this->lineId);
		$stmt->bindParam(":faceBook",$this->faceBook);
		$stmt->bindParam(":location",$this->location);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":createDate",$this->createDate);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_member 
        	SET 
			memberCode=:memberCode,
			memberName=:memberName,
			profile=:profile,
			homeNo=:homeNo,
			moo=:moo,
			tumbol=:tumbol,
			district=:district,
			province=:province,
			postalCode=:postalCode,
			telNo=:telNo,
			email=:email,
			lineId=:lineId,
			faceBook=:faceBook,
			location=:location,
			status=:status,
			createDate=:createDate
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":memberCode",$this->memberCode);
		$stmt->bindParam(":memberName",$this->memberName);
		$stmt->bindParam(":profile",$this->profile);
		$stmt->bindParam(":homeNo",$this->homeNo);
		$stmt->bindParam(":moo",$this->moo);
		$stmt->bindParam(":tumbol",$this->tumbol);
		$stmt->bindParam(":district",$this->district);
		$stmt->bindParam(":province",$this->province);
		$stmt->bindParam(":postalCode",$this->postalCode);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":lineId",$this->lineId);
		$stmt->bindParam(":faceBook",$this->faceBook);
		$stmt->bindParam(":location",$this->location);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function listMember(){
		$query="SELECT id,
		memberCode,
		memberName 
		FROM t_member ORDER BY memberName";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readOne(){
		$query='SELECT  id,
			memberCode,
			memberName,
			profile,
			homeNo,
			moo,
			tumbol,
			district,
			province,
			postalCode,
			telNo,
			email,
			lineId,
			faceBook,
			location,
			status,
			createDate
		FROM t_member WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$query="SELECT  
			A.id,
			A.memberCode,
			A.memberName,
			A.profile,
			A.homeNo,
			A.moo,
			A.tumbol,
			B.disName_TH AS district,
			C.prvName_TH AS province,
			A.postalCode,
			A.telNo,
			A.email,
			A.lineId,
			A.faceBook,
			A.location,
			A.status,
			A.createDate
		FROM t_member A 
		LEFT OUTER JOIN district B 
		ON A.district=B.code 
		LEFT OUTER JOIN province C 
		ON A.province=C.code
		WHERE 
		CONCAT(memberCode,' ',memberName) 
		LIKE :keyWord";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_member WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_member WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>