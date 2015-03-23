/*
This file is part of Ice Framework.

Ice Framework is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Ice Framework is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Ice Framework. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

function ProfileAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ProfileAdapter.inherits(AdapterBase);

this.currentUserId = null;

ProfileAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "profile_id",
	        "first_name",
	        "last_name",
	        "mobile_phone",
	        "department",
	        "gender",
	        "supervisor"
	];
});

ProfileAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" },
			{ "sTitle": "Profile Number" },
			{ "sTitle": "First Name" },
			{ "sTitle": "Last Name"},
			{ "sTitle": "Mobile"},
			{ "sTitle": "Department"},
			{ "sTitle": "Gender"},
			{ "sTitle": "Supervisor"}
	];
});

ProfileAdapter.method('getFormFields', function() {
	
	var country;
	
	if(this.checkPermission("Edit Country") == "Yes"){
		country = [ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}];
	}else{
		country = [ "country", {"label":"Country","type":"placeholder","remote-source":["Country","code","name"]}];
	}
	
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "first_name", {"label":"First Name","type":"text","validation":""}],
	        [ "last_name", {"label":"Last Name","type":"text","validation":""}],
	        [ "nationality", {"label":"Nationality","type":"select2","remote-source":["Nationality","id","name"]}],
	        [ "birthday", {"label":"Date of Birth","type":"date","validation":""}],
	        [ "gender", {"label":"Gender","type":"select","source":[["Male","Male"],["Female","Female"]]}],
	        [ "marital_status", {"label":"Marital Status","type":"select","source":[["Married","Married"],["Single","Single"],["Divorced","Divorced"],["Widowed","Widowed"],["Other","Other"]]}],
	        [ "address1", {"label":"Address Line 1","type":"text","validation":"none"}],
	        [ "address2", {"label":"Address Line 2","type":"text","validation":"none"}],
	        [ "city", {"label":"City","type":"text","validation":"none"}],
	        country,
	        [ "province", {"label":"Province","type":"select2","allow-null":true,"remote-source":["Province","id","name"]}],
	        [ "postal_code", {"label":"Postal/Zip Code","type":"text","validation":"none"}],
	        [ "home_phone", {"label":"Home Phone","type":"text","validation":"none"}],
	        [ "mobile_phone", {"label":"Mobile Phone","type":"text","validation":"none"}]
	];
});

ProfileAdapter.method('getSourceMapping' , function() {
	var k = this.sourceMapping ;
	k['supervisor'] = ["Profile","id","first_name+last_name"];
	return k;
});


ProfileAdapter.method('get', function() {
	var that = this;
	var sourceMappingJson = JSON.stringify(this.getSourceMapping());
	
	var req = {"map":sourceMappingJson};
	var reqJson = JSON.stringify(req);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'modProfileGetSuccessCallBack';
	callBackData['callBackFail'] = 'modProfileGetFailCallBack';
	
	this.customAction('get','modules=profiles',reqJson,callBackData);
});

ProfileAdapter.method('deleteProfileImage', function(empId) {
	var that = this;
	
	var req = {"id":empId};
	var reqJson = JSON.stringify(req);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'modProfileDeleteProfileImageCallBack';
	callBackData['callBackFail'] = 'modProfileDeleteProfileImageCallBack';
	
	this.customAction('deleteProfileImage','modules=profiles',reqJson,callBackData);
});

ProfileAdapter.method('modProfileDeleteProfileImageCallBack', function(data) {
	top.location.href = top.location.href;
});

ProfileAdapter.method('modProfileGetSuccessCallBack' , function(data) {
	var html = this.getCustomTemplate('myDetails.html');
	
	html = html.replace(/_id_/g,data.id);
	
	$("#"+this.getTableName()).html(html);
	var fields = this.getFormFields();
	for(var i=0;i<fields.length;i++) {
		$("#"+this.getTableName()+" #" + fields[i][0]).html(data[fields[i][0]]);
	}
	
	var subordinates = "";
	for(var i=0;i<data.subordinates.length;i++){
		if(data.subordinates[i].first_name != undefined && data.subordinates[i].first_name != null){
			subordinates += data.subordinates[i].first_name+" ";
		}
		
		if(data.subordinates[i].last_name != undefined && data.subordinates[i].last_name != null && data.subordinates[i].last_name != ""){
			subordinates += data.subordinates[i].last_name;
		}
		subordinates += "<br/>";
	}
	
	$("#"+this.getTableName()+" #subordinates").html(subordinates);
	
	$("#"+this.getTableName()+" #nationality_Name").html(data.nationality_Name);
	$("#"+this.getTableName()+" #employment_status_Name").html(data.employment_status_Name);
	$("#"+this.getTableName()+" #country_Name").html(data.country_Name);
	$("#"+this.getTableName()+" #province_Name").html(data.province_Name);
	$("#"+this.getTableName()+" #supervisor_Name").html(data.supervisor_Name);
	
	$("#"+this.getTableName()+" #name").html(data.first_name + " " + data.last_name);
	this.currentUserId = data.id;
	
	$("#"+this.getTableName()+" #profile_image_"+data.id).attr('src',data.image);
	
	if(this.checkPermission("Upload/Delete Profile Image") == "No"){
		$("#profileUploadProfileImage").remove();
		$("#profileDeleteProfileImage").remove();
	}
	
	
	this.cancel();
});

ProfileAdapter.method('modProfileGetFailCallBack' , function(data) {
	
});

ProfileAdapter.method('editProfile' , function() {
	this.edit(this.currentUserId);
});