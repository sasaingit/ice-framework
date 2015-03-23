<?php
if (!class_exists('ProfilesAdminManager')) {
	class ProfilesAdminManager extends AbstractModuleManager{

		public function initializeUserClasses(){
				
		}

		public function initializeFieldMappings(){
			
		}

		public function initializeDatabaseErrorMappings(){

		}

		public function setupModuleClassDefinitions(){
			$this->addModelClass('Profile');
		}

	}
}


if (!class_exists('Profile')) {
	class Profile extends ICEHRM_Record {
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getManagerAccess(){
			return array("get","element","save");
		}
	
		public function getUserAccess(){
			return array("get");
		}
	
		public function getUserOnlyMeAccess(){
			return array("element","save");
		}
	
		public function getUserOnlyMeAccessField(){
			return "id";
		}
	
		var $_table = 'Profiles';
	}
}