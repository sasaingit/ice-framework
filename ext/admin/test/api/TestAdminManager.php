<?php
if (!class_exists('TestAdminManager')) {
	
	class TestAdminManager extends AbstractModuleManager{
		
		public function initializeUserClasses(){
			
		}
		
		public function initializeFieldMappings(){
	
		}
		
		public function initializeDatabaseErrorMappings(){
		
		}
		
		public function setupModuleClassDefinitions(){
			$this->addModelClass('Test');
		}
		
	}
}


if (!class_exists('Test')) {
	class Test extends ICEHRM_Record {
		var $_table = 'Tests';
			
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
			
		public function getManagerAccess(){
			return array("get","element","save","delete");
		}
			
		public function getUserAccess(){
			return array("get","element");
		}
			
		public function validateSave($obj){
			return new IceResponse(IceResponse::SUCCESS,"");
		}
	}
}