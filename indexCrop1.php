 <?php
 include_once "config/config.php";
 include_once "config/database.php";
 include_once "objects/tpicfoldertest.php";
 $cnf=new Config();
 $rootPath=$cnf->path;
 $database=new Database();
 $db=$database->getConnection();
 $obj=new tpicfoldertest($db);

 ?>

<link rel="stylesheet" href="jquery.Jcrop.min.css" type="text/css" />
<script src="jquery.min.js"></script>
<script src="jquery.Jcrop.min.js"></script>

<style>


.crop {
    padding: 5px 25px 5px 25px;
    background: lightseagreen;
    border: #485c61 1px solid;
    color: #FFF;
    visibility: hidden;
}

#cropped_img {
    margin-top: 40px;
}
</style>
<div class="box box-primary">
  <table  class="table table-bordered">
    <tr>
       <td width="200px">Choose Picture :</td>
       <td width="500px">
          <select id="obj_choosePic" class="form-control">
          </select>
       </td>
       <td>
        <input type="button" value="Crop >>" class="btn btn-primary" id="obj_crop">
       </td>
    </tr>
  </table>
 
</div>
<div class="from-group">
    <div class="col-sm-12">
      <div class="box-header with-border">
        <table width="100%">
          <tr>
            <td>
              <h3 class="box-title"><b>Beef Picture</b></h3>
            </td>
            <td>

            </td>
          </tr>
        </table>
      </div>

      <div class="box box-warning">
        <div id="dvRender" class="img" >
            <div style="style:overflow: scroll;">
            <img src="/BeefAPI/IMG/Beef.jpg" id="cropbox" style="width:100%;height:500px" />
            </div>
        </div>
      </div>
    </div>
</div>
<div id="form-group">
  <div class="col-sm-12">
      <div class="box-header with-border">
      <h3 class="box-title"><b>Beef Result</b></h3>
      </div>
      <div class="box box-success">
      <table class="table table-bordered" id="tblDisplay" width="100%">
      <tr>
        <!--<th width="50px">No.
        </th>-->
        <th>File Name
        </th>
        <th>Area
        </th>
        <th width="100px">Classify
        </th>
        <th width="80px">Weight
        </th>
        <th width="80px">Confidence
        </th>
      </tr>
      <tbody id="tbResult">

      </tbody>
      </table>
    </div>
    </div>

</div>    
   
<script >
  var jsonData=[];

  function listPicture(){
    var url ="<?=$rootPath?>/tpicfoldertest/getData.php";
    setDDLPrefix(url,"#obj_choosePic","****Choose Picture****");
  }
  $(document).ready(function(){
        listPicture();
       

        $("#obj_choosePic").change(function(){
            var url="<?=$rootPath?>/tpicfoldertest/displayImage.php?id="+$("#obj_choosePic").val();
            $("#dvRender").load(url);
        }); 
     
      
  });
</script>
