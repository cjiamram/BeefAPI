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
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="tmember/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_member","memberCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","memberName","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","address","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","telNo","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","email","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","lineId","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_member","faceBook","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data["message"])){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["memberCode"].'</td>';
			echo '<td>'.$row["memberName"].'</td>';
			echo '<td>'.$row["profile"].'</td>';
			echo '<td>'.$row["address"].'</td>';
			
			echo '<td>'.$row["telNo"].'</td>';
			echo '<td>'.$row["email"].'</td>';
			echo '<td>'.$row["lineId"].'</td>';
			echo '<td>'.$row["faceBook"].'</td>';
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
