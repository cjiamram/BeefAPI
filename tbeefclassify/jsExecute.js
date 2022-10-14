var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDec.test($("#obj_classifyWeight").val());
		if (flag==false){
			$("#obj_classifyWeight").focus();
			return flag;
}
		flag=regDec.test($("#obj_beefRatio").val());
		if (flag==false){
			$("#obj_beefRatio").focus();
			return flag;
}
		flag=regDec.test($("#obj_fatRatio").val());
		if (flag==false){
			$("#obj_fatRatio").focus();
			return flag;
}
		flag=regDate.test($("#obj_createDate").val());
		if (flag==false){
				$("#obj_createDate").focus();
				return flag;
		}
		return flag;
}
function displayData(){
		var url="tbeefclassify/displayData.php?tableName=t_beefclassify&dbName=dbbeefclassify&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tbeefclassify/create.php';
		jsonObj={
			beefCode:$("#obj_beefCode").val(),
			userCode:$("#obj_userCode").val(),
			scanType:$("#obj_scanType").val(),
			segmentArea:$("#obj_segmentArea").val(),
			classifyGrade:$("#obj_classifyGrade").val(),
			classifyWeight:$("#obj_classifyWeight").val(),
			beefRatio:$("#obj_beefRatio").val(),
			fatRatio:$("#obj_fatRatio").val(),
			createDate:$("#obj_createDate").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tbeefclassify/update.php';
		jsonObj={
			beefCode:$("#obj_beefCode").val(),
			userCode:$("#obj_userCode").val(),
			scanType:$("#obj_scanType").val(),
			segmentArea:$("#obj_segmentArea").val(),
			classifyGrade:$("#obj_classifyGrade").val(),
			classifyWeight:$("#obj_classifyWeight").val(),
			beefRatio:$("#obj_beefRatio").val(),
			fatRatio:$("#obj_fatRatio").val(),
			createDate:$("#obj_createDate").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tbeefclassify/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_beefCode").val(data.beefCode);
			$("#obj_userCode").val(data.userCode);
			$("#obj_scanType").val(data.scanType);
			$("#obj_segmentArea").val(data.segmentArea);
			$("#obj_classifyGrade").val(data.classifyGrade);
			$("#obj_classifyWeight").val(data.classifyWeight);
			$("#obj_beefRatio").val(data.beefRatio);
			$("#obj_fatRatio").val(data.fatRatio);
			$("#obj_createDate").val(data.createDate);
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
			url="tbeefclassify/delete.php?id="+id;
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
			$("#obj_beefCode").val("");
			$("#obj_userCode").val("");
			$("#obj_scanType").val("");
			$("#obj_segmentArea").val("");
			$("#obj_classifyGrade").val("");
			$("#obj_classifyWeight").val("");
			$("#obj_beefRatio").val("");
			$("#obj_fatRatio").val("");
			$("#obj_createDate").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
