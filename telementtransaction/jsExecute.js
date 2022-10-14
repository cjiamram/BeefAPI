var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDec.test($("#obj_fat").val());
		if (flag==false){
			$("#obj_fat").focus();
			return flag;
}
		flag=regDec.test($("#obj_beef").val());
		if (flag==false){
			$("#obj_beef").focus();
			return flag;
}
		flag=regDec.test($("#obj_ratio").val());
		if (flag==false){
			$("#obj_ratio").focus();
			return flag;
}
		return flag;
}
function displayData(){
		var url="telementtransaction/displayData.php?tableName=t_elementtransaction&dbName=dbbeefjudge&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='telementtransaction/create.php';
		jsonObj={
			fat:$("#obj_fat").val(),
			beef:$("#obj_beef").val(),
			ratio:$("#obj_ratio").val(),
			beefCode:$("#obj_beefCode").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='telementtransaction/update.php';
		jsonObj={
			fat:$("#obj_fat").val(),
			beef:$("#obj_beef").val(),
			ratio:$("#obj_ratio").val(),
			beefCode:$("#obj_beefCode").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='telementtransaction/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_fat").val(data.fat);
			$("#obj_beef").val(data.beef);
			$("#obj_ratio").val(data.ratio);
			$("#obj_beefCode").val(data.beefCode);
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag;
		flag=validInput();
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
			url="telementtransaction/delete.php?id="+id;
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
function clearData(){
			$("#obj_fat").val("");
			$("#obj_beef").val("");
			$("#obj_ratio").val("");
			$("#obj_beefCode").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
