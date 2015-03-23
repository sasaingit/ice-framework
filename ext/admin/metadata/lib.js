/**
 * Author: Thilina Hasantha
 */


/**
 * CountryAdapter
 */

function CountryAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CountryAdapter.inherits(AdapterBase);



CountryAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "code",
	        "name"
	];
});

CountryAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" },
			{ "sTitle": "Name"}
	];
});

CountryAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "code", {"label":"Code","type":"text","validation":""}],
	        [ "name", {"label":"Name","type":"text","validation":""}]
	];
});


/**
 * ProvinceAdapter
 */

function ProvinceAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ProvinceAdapter.inherits(AdapterBase);



ProvinceAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "code",
	        "name",
	        "country"
	];
});

ProvinceAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" },
			{ "sTitle": "Name"},
			{ "sTitle": "Country"},
	];
});

ProvinceAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "code", {"label":"Code","type":"text","validation":""}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}]
	];
});

ProvinceAdapter.method('getFilters', function() {
	return [
	        [ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}]
	        
	];
});


/**
 * CurrencyTypeAdapter
 */

function CurrencyTypeAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CurrencyTypeAdapter.inherits(AdapterBase);



CurrencyTypeAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "code",
	        "name"
	];
});

CurrencyTypeAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" },
			{ "sTitle": "Name"}
	];
});

CurrencyTypeAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "code", {"label":"Code","type":"text","validation":""}],
	        [ "name", {"label":"Name","type":"text","validation":""}]
	];
});


/**
 * NationalityAdapter
 */

function NationalityAdapter(endPoint) {
	this.initAdapter(endPoint);
}

NationalityAdapter.inherits(AdapterBase);



NationalityAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name"
	];
});

NationalityAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name"}
	];
});

NationalityAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text","validation":""}]
	];
});




