<?php
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

$moduleName = 'dashboard';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
			  
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>
					People
					</h3>
					<p id="numberOfProfiles">
					.. Profiles
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-stalker"></i>
				</div>
				<a href="#" class="small-box-footer" id="profileLink">
					Manage Profiles <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div><!-- ./col -->						                        
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>Users</h3>
					<p id="numberOfUsers">
						.. Users
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer" id="usersLink">
					Manage Users <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>Settings</h3>
					<p>
						Configure IceHrm
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-settings"></i>
				</div>
				<a href="#" class="small-box-footer" id="settingsLink">
					Update Settings <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div><!-- ./col --> 
		                
	</div>
	
	

</div>
<script>
var modJsList = new Array();

modJsList['tabDashboard'] = new DashboardAdapter('Dashboard','Dashboard');

var modJs = modJsList['tabDashboard'];

$("#profileLink").attr("href",modJs.getCustomUrl('?g=admin&n=profiles&m=admin_Admin'));
$("#usersLink").attr("href",modJs.getCustomUrl('?g=admin&n=users&m=admin_System'));
$("#settingsLink").attr("href",modJs.getCustomUrl('?g=admin&n=settings&m=admin_System'));

modJs.getInitData();

</script>
<?php include APP_BASE_PATH.'footer.php';?>      