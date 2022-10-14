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
$path="tbeefclassify/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","beefCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","userCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","scanType","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","segmentArea","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","classifyGrade","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","classifyWeight","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","beefRatio","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","fatRatio","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_beefclassify","createDate","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["beefCode"].'</td>';
			echo '<td>'.$row["userCode"].'</td>';
			echo '<td>'.$row["scanType"].'</td>';
			echo '<td>'.$row["segmentArea"].'</td>';
			echo '<td>'.$row["classifyGrade"].'</td>';
			echo '<td>'.$row["classifyWeight"].'</td>';
			echo '<td>'.$row["beefRatio"].'</td>';
			echo '<td>'.$row["fatRatio"].'</td>';
			echo '<td>'.$row["createDate"].'</td>';
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
