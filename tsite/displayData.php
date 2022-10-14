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
$path="tsite/getData.php?keyWord=".$keyword;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_site","siteCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","siteName","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","address","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","district","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","province","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","postalcode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_site","coordinate","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["siteCode"].'</td>';
			echo '<td>'.$row["siteName"].'</td>';
			echo '<td><textarea class="form-control" rows="3" cols="30">'.$row["address"].'</textarea></td>';
			echo '<td>'.$row["district"].'</td>';
			echo '<td>'.$row["province"].'</td>';
			echo '<td>'.$row["postalcode"].'</td>';
			echo '<td><textarea rows="3" class="form-control" cols="30">'.$row["lat"].",".$row["lng"].'</textarea></td>';
			echo "<td>
			<button type='button' class='btn btn-info'
				onclick='getOneData(".$row['id'].")'>
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

<script>
	tablePage("#tblDisplay");
</script>
