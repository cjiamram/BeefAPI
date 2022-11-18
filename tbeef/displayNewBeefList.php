<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tbeef.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj = new tbeef($db);
	$stmt = $obj->getData();
	$num = $stmt->rowCount();
	$data=array();

	if($stmt->rowCount()>0){
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$objItem=array(
					"id"=>$id,
					"beefFolder"=>$beefFolder,
					"beefCode"=>$beefCode,
					"status"=>$status,
					"classifyJudge"=>$classifyJudge,
					"createDate"=>$createDate
				);
			array_push($data, $objItem);

		}
	}

	if(count($data)>0){
		echo "<table class='table table-bordered table-hover'>\n";
		echo "<thead>\n";
		echo "<tr>\n";
		echo "<th>No.</th>\n";
		echo "<th>ผูกสมาชิก</th>\n";
		echo "<th>หมายเลขเนื้อ</th>\n";
		echo "<th>วันที่</th>\n";
		echo "</tr>\n"
		echo "</thead>\n";
		echo "<tbody>\n";
		$i=1;
		foreach ($data as $row) {
			echo "<tr>\n";
			echo "<td>".$i++."</td>\n";
			$strB="<a class='btn btn-primary'><i class='fas fa-address-book' onclick=\"mapMember('".$rows["beefCode"]."')\"></i></a>\n";
			echo "<td>".$strB."</td>\n";
			echo "<td>".$rows["beefFolder"]."</td>\n";  
			echo "</tr>\n"; 	
		}
		echo "</tbody>\n";
		echo "</table>\n";
	}


?>