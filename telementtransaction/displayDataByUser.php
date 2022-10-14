<?php
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
include_once "../objects/telementtransaction.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$obj = new telementtransaction($db);
$data=array();
$cnf=new Config();
$beefCode=isset($_GET["beefCode"])?$_GET["beefCode"]:"";
$beefNo=isset($_GET["beefNo"])?$_GET["beefNo"]:"";
$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"Admin";


$stmt = $obj->getDataByUser($beefCode,$beefNo,$userCode);
$num = $stmt->rowCount();
if($num>0){
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$objItem=array(
					"id"=>$id,
					"fat"=>$fat,
					"beef"=>$beef,
					"ratio"=>$ratio,
					"beefCode"=>$beefCode,
					"square"=>$square,
					"fraction"=>$fraction
				);
				array_push($data, $objItem);
			}
}


echo "<table class='table table-bordered table-hover'>\n";
echo "<thead>";
		echo "<tr><th colspan='5'><label style='font-size:18px'>เลือกบริเวณเนื้อ</label></th></tr>\n";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>ปริมาณไขมันแทรก(cm^2)</th>";
			echo "<th>ปริมาณเนื้อแดง(cm^2)</th>";
			echo "<th>สัดส่วน%(ไขมันแทรก/เนื้อ)</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(count($data)>0){
echo "<tbody>";
$i=1;
$sumFat=0;
$sumBeef=0;

foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			$strFat=intval($row["fat"])*0.26/100;
			$sumFat+=$strFat;
			$strBeef=intval($row["beef"])*0.26/100;
			$sumBeef+=$strBeef;
			echo '<td align="center">'.number_format($strFat, 2, '.', ' ').'</td>';
			echo '<td align="center">'. number_format($strBeef, 2, '.', ' ') .'</td>';
			$percent=  number_format(($strFat/$strBeef)*100, 2, '.', ' ')  ."%";	
			echo '<td align="center">'.$percent."(".$row["fraction"].")".'</td>';
			echo "<td align='center'>
			
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
		
}

$n=$i-1;

ob_start();
$fat=$sumFat/$n;
$beef=$sumBeef/$n;
$strT='python3 getFraction.py '.intval($fat).' '.intval($beef);
passthru($strT);
$output = ob_get_clean();
$tpercent=number_format(($fat/$beef)*100, 2, '.', ' ')  ."%";

echo "<tr><td ><label>สรุปผล</label></td><td align='center'>".number_format($fat, 2, '.', ' ') ."</td><td align='center'>".number_format($beef, 2, '.', ' ') ."</td><td  align='center'>".$tpercent."(".$output.")"."</td><td>&nbsp;</td></tr>\n";
echo "</tbody>";
echo "</table>\n";
}
?>
