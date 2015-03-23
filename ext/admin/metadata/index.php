<?php 
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

$moduleName = 'metadata';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
			  
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabCountry" href="#tabPageCountry">Countries</a></li>
		<li><a id="tabProvince" href="#tabPageProvince">Provinces</a></li>
		<li><a id="tabCurrencyType" href="#tabPageCurrencyType">Currency Types</a></li>
		<li><a id="tabNationality" href="#tabPageNationality">Nationality</a></li>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageCountry">
			<div id="Country" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="CountryForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageProvince">
			<div id="Province" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="ProvinceForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageCurrencyType">
			<div id="CurrencyType" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="CurrencyTypeForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageNationality">
			<div id="Nationality" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="NationalityForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
	</div>

</div>
<script>
var modJsList = new Array();

modJsList['tabCountry'] = new CountryAdapter('Country','Country');
modJsList['tabCountry'].setRemoteTable(true);

modJsList['tabProvince'] = new ProvinceAdapter('Province','Province');
modJsList['tabProvince'].setRemoteTable(true);

modJsList['tabCurrencyType'] = new CurrencyTypeAdapter('CurrencyType','CurrencyType');
modJsList['tabCurrencyType'].setRemoteTable(true);

modJsList['tabNationality'] = new NationalityAdapter('Nationality','Nationality');
modJsList['tabNationality'].setRemoteTable(true);

var modJs = modJsList['tabCountry'];

</script>
<?php include APP_BASE_PATH.'footer.php';?>      