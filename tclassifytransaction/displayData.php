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
$path="tclassifytransaction/getDataByCode.php?beefCode=".$beefCode;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","beefCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","beefNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","grade","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","fat","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","beef","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_classifytransaction","ratio","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["beefCode"].'</td>';
			echo '<td>'.$row["beefNo"].'</td>';
			echo '<td>'.$row["grade"].'</td>';
			echo '<td>'.$row["fat"].'</td>';
			echo '<td>'.$row["beef"].'</td>';
			echo '<td>'.$row["ratio"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
