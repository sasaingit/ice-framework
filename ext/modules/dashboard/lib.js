/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

function DashboardAdapter(endPoint) {
	this.initAdapter(endPoint);
}

DashboardAdapter.inherits(AdapterBase);



DashboardAdapter.method('getDataMapping', function() {
	return [];
});

DashboardAdapter.method('getHeaders', function() {
	return [];
});

DashboardAdapter.method('getFormFields', function() {
	return [];
});


DashboardAdapter.method('get', function(callBackData) {
});


DashboardAdapter.method('getLastLogin', function() {
	var that = this;
	var object = {};
	var reqJson = JSON.stringify({});
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'getLastLoginSuccessCallBack';
	callBackData['callBackFail'] = 'getLastLoginFailCallBack';
	
	this.customAction('getLastLogin','modules=dashboard',reqJson,callBackData);
});



DashboardAdapter.method('getLastLoginSuccessCallBack', function(callBackData) {
	var lastLogin = callBackData;
	$("#lastLoginTime").html(lastLogin);
});

DashboardAdapter.method('getLastLoginFailCallBack', function(callBackData) {
	
});
