var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDec.test($("#obj_cowAge").val());
		if (flag==false){
			$("#obj_cowAge").focus();
			return flag;
}
		flag=regDec.test($("#obj_feedTime").val());
		if (flag==false){
			$("#obj_feedTime").focus();
			return flag;
}
		flag=regDate.test($("#obj_createDate").val());
		if (flag==false){
				$("#obj_createDate").focus();
				return flag;
		}
		flag=regDate.test($("#obj_busheryDate").val());
		if (flag==false){
				$("#obj_busheryDate").focus();
				return flag;
		}
		flag=regDec.test($("#obj_cowWeight").val());
		if (flag==false){
			$("#obj_cowWeight").focus();
			return flag;
}
		flag=regDec.test($("#obj_dryAge").val());
		if (flag==false){
			$("#obj_dryAge").focus();
			return flag;
}
		flag=regDec.test($("#obj_coldWeight").val());
		if (flag==false){
			$("#obj_coldWeight").focus();
			return flag;
}
		flag=regDec.test($("#obj_warmWeight").val());
		if (flag==false){
			$("#obj_warmWeight").focus();
			return flag;
}
		flag=regDec.test($("#obj_classifyWeight").val());
		if (flag==false){
			$("#obj_classifyWeight").focus();
			return flag;
}
		return flag;
}
function displayData(){
		var url="tcow/displayData.php?tableName=t_cow&dbName=dbbeefclassify&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tcow/create.php';
		jsonObj={
			cowCode:$("#obj_cowCode").val(),
			breedType:$("#obj_breedType").val(),
			cowAge:$("#obj_cowAge").val(),
			description:$("#obj_description").val(),
			feedTime:$("#obj_feedTime").val(),
			createDate:$("#obj_createDate").val(),
			memberCode:$("#obj_memberCode").val(),
			busheryDate:$("#obj_busheryDate").val(),
			cowWeight:$("#obj_cowWeight").val(),
			dryAge:$("#obj_dryAge").val(),
			coldWeight:$("#obj_coldWeight").val(),
			warmWeight:$("#obj_warmWeight").val(),
			classifyWeight:$("#obj_classifyWeight").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tcow/update.php';
		jsonObj={
			cowCode:$("#obj_cowCode").val(),
			breedType:$("#obj_breedType").val(),
			cowAge:$("#obj_cowAge").val(),
			description:$("#obj_description").val(),
			feedTime:$("#obj_feedTime").val(),
			createDate:$("#obj_createDate").val(),
			memberCode:$("#obj_memberCode").val(),
			busheryDate:$("#obj_busheryDate").val(),
			cowWeight:$("#obj_cowWeight").val(),
			dryAge:$("#obj_dryAge").val(),
			coldWeight:$("#obj_coldWeight").val(),
			warmWeight:$("#obj_warmWeight").val(),
			classifyWeight:$("#obj_classifyWeight").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tcow/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_cowCode").val(data.cowCode);
			$("#obj_breedType").val(data.breedType);
			$("#obj_cowAge").val(data.cowAge);
			$("#obj_description").val(data.description);
			$("#obj_feedTime").val(data.feedTime);
			$("#obj_createDate").val(data.createDate);
			$("#obj_memberCode").val(data.memberCode);
			$("#obj_busheryDate").val(data.busheryDate);
			$("#obj_cowWeight").val(data.cowWeight);
			$("#obj_dryAge").val(data.dryAge);
			$("#obj_coldWeight").val(data.coldWeight);
			$("#obj_warmWeight").val(data.warmWeight);
			$("#obj_classifyWeight").val(data.classifyWeight);
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
			url="tcow/delete.php?id="+id;
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
			$("#obj_cowCode").val("");
			$("#obj_breedType").val("");
			$("#obj_cowAge").val("");
			$("#obj_description").val("");
			$("#obj_feedTime").val("");
			$("#obj_createDate").val("");
			$("#obj_memberCode").val("");
			$("#obj_busheryDate").val("");
			$("#obj_cowWeight").val("");
			$("#obj_dryAge").val("");
			$("#obj_coldWeight").val("");
			$("#obj_warmWeight").val("");
			$("#obj_classifyWeight").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
