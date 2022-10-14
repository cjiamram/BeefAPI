<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../lib/classAPI.php";
	include_once "../config/config.php";
	$cnf=new Config();

	$folder=isset($_GET["folder"])?$_GET["folder"]:"N001";
	$api=new ClassAPI();
	$url=$cnf->deepURL."/getImgFromFolder/".$folder;
	$data=$api->getAPI($url);
	

	if($data!==""){
		echo "<thead>\n";
		echo "<th>No.</th>\n";
		echo "<th>เลือกภาพ</th>\n";
		echo "</thead>\n";

		$i=1;
		echo "<tbody>\n";
		if(count($data)>0){
				
				foreach ($data as $row) {
					echo "<tr>\n";
					echo "<td width='50px'>\n";
					echo $i++;
					echo "</td>\n";
					

					$objArr=explode('\\',$row["imgName"]);
					if(count($objArr)>1){
						$l=count($objArr);
						$imgName=$objArr[$l-1];
					}else{
						$objArr=explode('/',$row["imgName"]);
						$l=count($objArr);
						$imgName=$objArr[$l-1];
					}
					
					$strBtn="<button type='button' class='btn btn-info'
						onclick=\"getClassify('".$imgName."','".$i."')\">
						<span class='fa fa-eye'></span>
					</button>\n";

					echo "<td><div class='col-sm-10'>".$imgName."</div><div class='col-sm-2'>".$strBtn."</div>\n";
					echo "</td>\n";
					
					echo "</td></tr>\n";
				  }
		}
		echo "</tbody>";
	}




?>