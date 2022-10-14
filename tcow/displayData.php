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
$path="tcow/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_cow","cowCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","breedType","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","cowAge","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","description","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","feedTime","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","memberCode","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","busheryDate","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","cowWeight","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","dryAge","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","coldWeight","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","warmWeight","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_cow","classifyWeight","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data)){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["cowCode"].'</td>';
			echo '<td>'.$row["breedType"].'</td>';
			echo '<td>'.$row["cowAge"].'</td>';
			echo '<td>'.$row["description"].'</td>';
			echo '<td>'.$row["feedTime"].'</td>';
			echo '<td>'.$row["memberCode"].'</td>';
			//echo '<td>'.$row["busheryDate"].'</td>';
			//echo '<td>'.$row["cowWeight"].'</td>';
			//echo '<td>'.$row["dryAge"].'</td>';
			//echo '<td>'.$row["coldWeight"].'</td>';
			//echo '<td>'.$row["warmWeight"].'</td>';
			//echo '<td>'.$row["classifyWeight"].'</td>';
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
