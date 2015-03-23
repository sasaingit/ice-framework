<?php
if (!class_exists('MetadataAdminManager')) {
	
	class MetadataAdminManager extends AbstractModuleManager{
		
		public function initializeUserClasses(){
			
		}
		
		public function initializeFieldMappings(){
			
		}
		
		public function initializeDatabaseErrorMappings(){
			
		}
		
		public function setupModuleClassDefinitions(){			
			$this->addModelClass('Country');
			$this->addModelClass('Province');
			$this->addModelClass('CurrencyType');
			$this->addModelClass('Nationality');
		}
		
	}
}

if (!class_exists('Country')) {
	class Country extends ICEHRM_Record {
		var $_table = 'Country';
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserAccess(){
			return array();
		}
	
		public function getAnonymousAccess(){
			return array("get","element");
		}
	}	
}

if (!class_exists('Province')) {
	class Province extends ICEHRM_Record {
		var $_table = 'Province';
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserAccess(){
			return array();
		}
	
		public function getAnonymousAccess(){
			return array("get","element");
		}
	}	
}


if (!class_exists('CurrencyType')) {
	class CurrencyType extends ICEHRM_Record {
		var $_table = 'CurrencyTypes';
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserAccess(){
			return array();
		}
	
		public function getAnonymousAccess(){
			return array("get","element");
		}
	}	
}


if (!class_exists('Nationality')) {
	class Nationality extends ICEHRM_Record {
		var $_table = 'Nationality';
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserAccess(){
			return array();
		}
	
		public function getAnonymousAccess(){
			return array("get","element");
		}
	}
}





