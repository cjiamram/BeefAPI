<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $rootPath=$cnf->path;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);
      $url=$cnf->restURL;

?>
<link rel="stylesheet" href="<?=$rootPath?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?=$rootPath?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
       <b>ระบบจัดการการฝึกงาน</b>

        <small>>>ข้อมูลสถานที่ฝึกงาน</small>
      </h1>
      <ol class="breadcrumb">
   
        <!--<table width="40" cellspacing="2" cellpading="2">
          <tr>
            <td width="100%" align="center">
                <input type="button" id="btnInput"   class="btn btn-primary col-sm-12"  value="สร้าง">
            </td>
            
          </tr>
        </table>-->
        <!--<input type="button" id="btnSearch"  class="btn btn-success pull-right"  value="ค้นหาข้นสูง">-->
        <input type="button" id="btnInput"   class="btn btn-primary pull-right"  value="สร้าง">


      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box"></div>
        <div class="form-group">
          <div class="col-sm-12">
             <div class="col-sm-6">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearch">
                </div>
             </div>
             <div>
              <div  class="col-sm-4">
              </div>
          </div>
          </div>
        </div>

      <div>&nbsp;</div>
      <div class="col-sm-12">
      <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b>ข้อมูลสถานที่ฝึกงาน</b></h3>
      </div>
      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" style="width:800px" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลสถานปฏิบัติงาน</h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" >
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" >
                    <input type="button" id="btnNew" value="เพิ่ม"  class="btn btn-primary pull-left" >

                  </div>
          </div>
      </div>
     </div>
   </div>

     <div class="modal fade" id="modal-search">
        <div class="modal-dialog" id="dvSearch">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Advance Search</h4>
           </div>
           <div class="modal-body" id="dvAdvBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnAdvCose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnAdvSearch" value="ค้นหา"  class="btn btn-primary" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>
<script src="<?=$rootPath?>/tsite/jsExecute.js"></script>
<script>

function listProvince(){
    var url="<?=$rootPath?>/province/listData.php";
    console.log(url);
    setDDL(url,"#obj_province");
  }

  function listDistrict(province){
    var url="<?=$rootPath?>/district/listData.php?province="+province;
    setDDL(url,"#obj_district");
  }

function createCode(){
      var url="<?=$rootPath?>/tsite/genCode.php";
      var data=queryData(url);
      $("#obj_siteCode").val(data.MXCode);  
  }

 function loadInput(){
      var url="<?=$rootPath?>/tsite/input.php";
      $("#dvInputBody").load(url);
      createCode();
 }

function displayData(){ 
    var url="<?=$rootPath?>/tsite/displayData.php?keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
 }

 function loadPage(){
    loadInput();
    displayData();
 }

 function readMap(id){
    var url="<?=$rootPath?>/mapSearch.php?id="+id;
    $("#dvMap").load(url);
  }


 function getOneData(id){
    $("#modal-input").modal("toggle");
    readOne(id);
    readMap(id);
 }

 function validInput(){
    var flag=true;
    return flag;
}
function displayData(){
    var url="tsite/displayData.php?tableName=t_site&dbName=dbcoop&keyWord="+$("#txtSearch").val();
    $("#tblDisplay").load(url);
}

function clearData(){
      $("#obj_siteCode").val("");
      $("#obj_siteName").val("");
      $("#obj_address").val("");
      $("#obj_district").val("");
      $("#obj_province").val("");
      $("#obj_postalcode").val("");
      $("#obj_location").val("");
      $("#obj_id").val("");
}

function createData(){
    var url='tsite/create.php';
    var locations=$("#obj_location").val().split(",");
    var lat="";
    var lng="";
    if(locations.length>=0){
      lat=locations[0];
      lng=locations[1];
    }
    jsonObj={
      siteCode:$("#obj_siteCode").val(),
      siteName:$("#obj_siteName").val(),
      address:$("#obj_address").val(),
      district:$("#obj_district").val(),
      province:$("#obj_province").val(),
      postalcode:$("#obj_postalcode").val(),
      photo:$("#obj_file").val(),
      lat:lat,
      lng:lng
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='tsite/update.php';
    var locations=$("#obj_location").val().split(",");
    var lat="";
    var lng="";
    if(locations.length>=0){
      lat=locations[0];
      lng=locations[1];
    }
    jsonObj={
      siteCode:$("#obj_siteCode").val(),
      siteName:$("#obj_siteName").val(),
      address:$("#obj_address").val(),
      district:$("#obj_district").val(),
      province:$("#obj_province").val(),
      postalcode:$("#obj_postalcode").val(),
      lat:lat,
      lng:lng,
      photo:$("#obj_file").val(),
      id:$("#obj_id").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    //console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function readOne(id){
    var url='tsite/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_siteCode").val(data.siteCode);
      $("#obj_siteName").val(data.siteName);
      $("#obj_address").val(data.address);
      
      $("#obj_province").val(data.province);
      listDistrict(data.province)

      $("#obj_district").val(data.district);
      $("#obj_postalcode").val(data.postalcode);
      $("#obj_location").val(data.lat+","+data.lng);
      $("#obj_file").val(data.photo);
      $("#obj_id").val(data.id);
    }
}
function saveData(){
    var flag;
    flag=validInput();

    if($("#obj_picture").val()!=""){

                  var file=$("#obj_picture").val().split('\\').pop();
                  var fileName =  "<?=$url?>/uploads/"+$("#obj_siteCode").val()+"/"+file;
                  fileUpload("obj_picture","../uploads/"+$("#obj_siteCode").val());
                  $("#obj_file").val(fileName);
    }


    if(flag==true){
          if($("#obj_id").val()!=""){
      flag=updateData();
      }else{
      flag=createData();
    }
    if(flag==true){
      swal.fire({
      title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
      type: "success",
      buttons: [false, "ปิด"],
      dangerMode: true,
    });
    displayData();
    }
    else{
      swal.fire({
      title: "การบันทึกข้อมูลผิดพลาด",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
    });
    }
    }else{
      swal.fire({
      title: "รูปแบบการกรอกข้อมูลไม่ถูกต้อง",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
      });
      }
}

 $( document ).ready(function() {
    loadPage();


    $("#btnInput").click(function(){
        clearData();
        createCode();
    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
        clearData();
        displayData();

    });

    $("#btnClose").click(function(){
      $("#modal-input").modal("hide");
    });

    $("#btnNew").click(function(){
      clearData();
    });

    $("#btnInput").click(function(){
       $("#modal-input").modal("toggle");

    });


    $("#obj_province").change(function(){
        listDistrict($("#obj_province").val());
    });
 });

</script>
