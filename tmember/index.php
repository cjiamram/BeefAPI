<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $rootPath=$cnf->path;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);
      $module=$cnf->systemModule;


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
      $lblInput= $objLbl->getLabel("t_member","memberInfo","th");

      //print_r($lastPath);

?>
<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
        <b><?= $module?></b>

        <small>>><?=$lblInput?></small>
      </h1>
      <ol class="breadcrumb">
   
        <input type="button" id="btnSearch"  class="btn btn-success pull-right"  value="ค้นหาข้นสูง">
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
      <h3 class="box-title"><b><?=$lblInput?></b></h3>
      </div>
      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" style="width:850px" >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?=$lblInput?></h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" data-dismiss="modal">
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
                    <input type="button" id="btnAdvClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnAdvSearch" value="ค้นหา"  class="btn btn-primary" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>
<script src="<?=$rootPath.'/'.$lastPath?>/jsExecute.js"></script>
<script>

 function loadInput(){
      var url="<?=$rootPath.'/'.$lastPath?>/input.php";
      $("#dvInputBody").load(url);
 }

function displayData(){
 
    var url="<?=$rootPath.'/'.$lastPath?>/displayData.php??keyWord="+$("#txtSearch").val();
    console.log(url);
    $("#tblDisplay").load(url);
 }

 function loadPage(){
    loadInput();
    displayData();
 }


function createData(){
    var url='tmember/create.php';
    jsonObj={
      memberCode:$("#obj_memberCode").val(),
      memberName:$("#obj_memberName").val(),
      profile:$("#obj_profile").val(),
      homeNo:$("#obj_homeNo").val(),
      moo:$("#obj_moo").val(),
      tumbol:$("#obj_tumbol").val(),
      district:$("#obj_district").val(),
      province:$("#obj_province").val(),
      postalCode:$("#obj_postalCode").val(),
      telNo:$("#obj_telNo").val(),
      email:$("#obj_email").val(),
      lineId:$("#obj_lineId").val(),
      faceBook:$("#obj_faceBook").val(),
      location:$("#obj_location").val(),
      status:0,
      createDate:$("#obj_createDate").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='tmember/update.php';
    jsonObj={
      memberCode:$("#obj_memberCode").val(),
      memberName:$("#obj_memberName").val(),
      profile:$("#obj_profile").val(),
      homeNo:$("#obj_homeNo").val(),
      moo:$("#obj_moo").val(),
      tumbol:$("#obj_tumbol").val(),
      district:$("#obj_district").val(),
      province:$("#obj_province").val(),
      postalCode:$("#obj_postalCode").val(),
      telNo:$("#obj_telNo").val(),
      email:$("#obj_email").val(),
      lineId:$("#obj_lineId").val(),
      faceBook:$("#obj_faceBook").val(),
      location:$("#obj_location").val(),
      status:0,
      createDate:$("#obj_createDate").val(),
      id:$("#obj_id").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    console.log(jsonData);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function readOne(id){
    var url='tmember/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_memberCode").val(data.memberCode);
      $("#obj_memberName").val(data.memberName);
      $("#obj_profile").val(data.profile);
      $("#obj_homeNo").val(data.homeNo);
      $("#obj_moo").val(data.moo);
      $("#obj_tumbol").val(data.tumbol);
      $("#obj_district").val(data.district);
      $("#obj_province").val(data.province);
      $("#obj_postalCode").val(data.postalCode);
      $("#obj_telNo").val(data.telNo);
      $("#obj_email").val(data.email);
      $("#obj_lineId").val(data.lineId);
      $("#obj_faceBook").val(data.faceBook);
      $("#obj_location").val(data.location);
      $("#obj_createDate").val(data.createDate);
      $("#obj_id").val(data.id);
    }
}

function isExistMember(memberCode){
  var url="<?=$rootPath?>/tmember/isMemberExist.php?memberCode="+memberCode;
  var data=queryData(url);
  return data.flag;
}

function saveData(){
    var flag;
    flag=true;
    if(flag==true){
          if($("#obj_id").val()!=""){
      flag=updateData();
      }else{
      

      if(isExistMember($("#obj_memberCode").val())==false)  
        flag=createData();
      else
      {
        swal.fire({
          title: "เลขบัตรประชาชนดังกล่าวถูกใช้แล้วกรุณาใช้รหัสใหม่",
          type: "error",
          buttons: [false, "ปิด"],
          dangerMode: true,
        });
        return;
      }
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
function confirmDelete(id){
    swal.fire({
      title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
      text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
      type: "warning",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
      showCancelButton: true,
      showConfirmButton: true
    }).then((willDelete) => {
    if (willDelete.value) {
      url="tmember/delete.php?id="+id;
      executeGet(url,false,"");
      displayData();
    swal.fire({
      title: "ลบข้อมูลเรียบร้อยแล้ว",
      type: "success",
      buttons: "ตกลง",
    });
    } else {
      swal.fire({
      title: "ยกเลิกการทำรายการ",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
    })
    }
    });
}



 $( document ).ready(function() {
    loadPage();
    $("#btnInput").click(function(){
        $("#modal-input").modal("toggle");
        clearData();
        $("#obj_code").val(genCode());
    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
    });
 });

</script>
