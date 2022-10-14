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
			echo "<th width='60px'>No.</th>";
			echo "<th>".$objLbl->getLabel("t_cow","memberName","TH")."</th>";
			echo "<th  width='250px'>".$objLbl->getLabel("t_cow","breedType","TH")."</th>";
			echo "<th width='200px'>".$objLbl->getLabel("t_cow","cowAge","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_cow","description","TH")."</th>";
			echo "<th width='150px'>".$objLbl->getLabel("t_cow","feedTime","TH")."</th>";
			
			echo "<th width='100px'>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data)){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td width="\60px\">'.$i++.'</td>';
			echo '<td>'.$row["memberName"].'</td>';
			echo '<td>'.$row["breedType"].'</td>';
			echo '<td>'.$row["cowAge"].'</td>';
			echo '<td>'.$row["description"].'</td>';
			echo '<td>'.$row["feedTime"].'</td>';
			
			
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
