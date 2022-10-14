<?php
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$beefCode=isset($_GET["beefCode"])?$_GET["beefCode"]:"";
$beefNo=isset($_GET["beefNo"])?$_GET["beefNo"]:"";
$path="telementtransaction/getData.php?beefNo=".$beefNo."&beefCode=".$beefCode;
$url=$cnf->restURL.$path;
//print_r($url);
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<table class=\"table table-bordered table-hover\">\n";
echo "<thead>";
		echo "<tr><th colspan='5'><label style='font-size:18px'>เลือกบริเวณเนื้อ</label></th></tr>\n";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>ปริมาณไขมันแทรก</th>";
			echo "<th>ปริมาณเนื้อแดง</th>";
			echo "<th>สัดส่วน (ไขมันแทรก/เนื้อ)</th>";
			echo "<th>พื้นที่</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			$strFat=intval($row["fat"])*0.26/100;
			$strBeef=intval($row["beef"])*0.26/100;
			echo '<td align="right">'.$strFat.'</td>';
			echo '<td align="right">'.$strBeef.'</td>';
			echo '<td align="right">'.$row["fraction"].'</td>';
			echo '<td align="enter">'.$row["square"].'</td>';
			echo "<td align='center'>
			
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
echo "</table>\n";
}
?>
