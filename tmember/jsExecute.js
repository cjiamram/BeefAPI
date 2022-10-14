var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDate.test($("#obj_createDate").val());
		if (flag==false){
				$("#obj_createDate").focus();
				return flag;
		}
		return flag;
}


function clearData(){
			$("#obj_memberCode").val("");
			$("#obj_memberName").val("");
			$("#obj_profile").val("");
			$("#obj_homeNo").val("");
			$("#obj_moo").val("");
			$("#obj_tumbol").val("");
			$("#obj_district").val("");
			$("#obj_province").val("");
			$("#obj_postalCode").val("");
			$("#obj_telNo").val("");
			$("#obj_email").val("");
			$("#obj_lineId").val("");
			$("#obj_faceBook").val("");
			$("#obj_location").val("");
			$("#obj_status").val("");
			$("#obj_createDate").val(date("Y-m-d"));
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
