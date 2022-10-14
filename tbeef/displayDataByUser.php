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
$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"Admin";
$path="tbeef/getDataByUser.php?userCode=".$userCode;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_beef","beefFolder","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beef","beefCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beef","status","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_beef","classifyJudge","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_beef","createDate","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["beefFolder"].'</td>';
			echo '<td>'.$row["beefCode"].'</td>';
			echo '<td>'.$row["status"].'</td>';
			//echo '<td>'.$row["classifyJudge"].'</td>';
			//echo '<td>'.$row["createDate"].'</td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			</td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
