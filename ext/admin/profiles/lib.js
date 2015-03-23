/**
 * Author: Thilina Hasantha
 */

function ProfileAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ProfileAdapter.inherits(AdapterBase);



ProfileAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "first_name",
	        "last_name",
	        "email",
	        "country"
	];
});

ProfileAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" },
			{ "sTitle": "First Name" },
			{ "sTitle": "Last Name"},
			{ "sTitle": "Email"},
			{ "sTitle": "Country"}
	];
});

ProfileAdapter.method('getFormFields', function() {
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
	        [ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}],
	        [ "province", {"label":"Province","type":"select2","allow-null":true,"remote-source":["Province","id","name"]}],
	        [ "postal_code", {"label":"Postal/Zip Code","type":"text","validation":"none"}],
	        [ "home_phone", {"label":"Home Phone","type":"text","validation":"none"}],
	        [ "mobile_phone", {"label":"Mobile Phone","type":"text","validation":"none"}],
	        [ "email", {"label":"Email","type":"text","validation":"email"}],
	        [ "supervisor", {"label":"Supervisor","type":"select2","allow-null":true,"remote-source":["Profile","id","first_name+last_name"]}]
	];
});

ProfileAdapter.method('getFilters', function() {
	return [
	        [ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}]
	];
});

ProfileAdapter.method('getActionButtonsHtml', function(id) {
	var html = '<div style="width:110px;"><img class="tableActionButton" src="_BASE_images/user.png" style="cursor:pointer;" rel="tooltip" title="Login as this Profile" onclick="modJs.setAdminProfile(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/edit.png" style="cursor:pointer;margin-left:15px;" rel="tooltip" title="Edit" onclick="modJs.edit(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/delete.png" style="margin-left:15px;cursor:pointer;" rel="tooltip" title="Terminate Profile" onclick="modJs.deleteRow(_id_);return false;"></img></div>';
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	return html;
});