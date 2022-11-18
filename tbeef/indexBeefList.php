<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $module=$cnf->systemModule;

      $rootPath=$cnf->path;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);

      function mb_basename($path) {
            if (preg_match('@^.*[\\\\/]([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            } else if (preg_match('@^([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            }
            return '';
      }
      $dir= getcwd();

      $lastPath=mb_basename($dir);
      $lblInput= $objLbl->getLabel("t_cow","cowInfo","th");


?>
<section class="content-header">
 
      <div class="col-sm-12">
      	<span style="color:white">
        	<b><?=$module?></b>

        		<small>>><?=$lblInput?></small>
        </span>
      </div>

      <div class="col-sm-12">&nbsp;
      </div> 


</section>