<?php
class UIManager{
	
	private static $me = null;
	
	var $user;
	var $currentProfile;
	var $switchedProfile;
	
	var $currentProfileBlock = null;
	var $switchedProfileBlock = null;
	
	var $tempates = array();
	
	
	private function __construct(){
		
	}
	
	public static function getInstance(){
		if(empty(self::$me)){
			self::$me = new UIManager();
		}	
		
		return self::$me;
	}
	
	private function getTemplate($name, $type){
	
		if(isset($this->tempates[$name])){
			return $this->tempates[$name];
		}
	
		$this->tempates[$name] = file_get_contents(APP_BASE_PATH."templates/".$type."/".$name.".html");
	
		return $this->tempates[$name];
	}
	
	public function populateTemplate($name, $type, $params){
		$template= $this->getTemplate($name, $type);
		foreach($params as $key=>$value){
			$template = str_replace("#_".$key."_#", $value, $template);
		}
		
		return $template;
	}
	
	public function setCurrentUser($user){
		$this->user = $user;	
	}
	
	public function setHomeLink($homeLink){
		$this->homeLink = $homeLink;	
	}
	
	public function setProfiles($profileCurrent, $profileSwitched){
		$this->currentProfile = $profileCurrent;
		$this->switchedProfile = $profileSwitched;	
		
		if(!empty($profileCurrent) && !empty($profileSwitched)){
			
			$this->currentProfileBlock = array(
				"profileImage"=>$profileCurrent->image,
				"firstName"=>$profileCurrent->first_name,
				"lastName"=>$profileCurrent->last_name
			);
			
			$this->switchedProfileBlock = array(
				"profileImage"=>$profileSwitched->image,
				"firstName"=>$profileSwitched->first_name,
				"lastName"=>$profileSwitched->last_name
			);
			
		} else if(!empty($profileCurrent)){	
			
			$this->currentProfileBlock = array(
					"profileImage"=>$profileCurrent->image,
					"firstName"=>$profileCurrent->first_name,
					"lastName"=>$profileCurrent->last_name
			);
			
		} else if(!empty($profileSwitched)){
			
			$this->currentProfileBlock = array(
					"profileImage"=>BASE_URL."images/user_male.png",
					"firstName"=>$this->user->username,
					"lastName"=>""
			);
				
			$this->switchedProfileBlock = array(
					"profileImage"=>$profileSwitched->image,
					"firstName"=>$profileSwitched->first_name,
					"lastName"=>$profileSwitched->last_name
			);

		}else{

			$this->currentProfileBlock = array(
					"profileImage"=>BASE_URL."images/user_male.png",
					"firstName"=>$this->user->username,
					"lastName"=>""
			);
		}
	}

	public function getProfileBlocks(){
		$tempateProfileBlock = "";
		$tempateProfileBlock = $this->populateTemplate('profile_info', 'app', $this->currentProfileBlock);	
		if(!empty($this->switchedProfileBlock)){
			$tempateProfileBlock .= $this->populateTemplate('switched_profile_info', 'app', $this->switchedProfileBlock);
		}
		return $tempateProfileBlock;		
	}
	
	public function getMenuBlocks(){
		$manuItems = array();
		$manuItems[] = new MenuItemTemplate('menuButtonNotification', array());
		if($this->user->user_level == "Admin"){
			$manuItems[] = new MenuItemTemplate('menuButtonSwitchProfile', array());
		}
		
		if(!empty($this->currentProfile)){
			
			$manuItems[] = new MenuItemTemplate('menuButtonProfile', array(
					"profileImage"=>$this->currentProfile->image,
					"firstName"=>$this->currentProfile->first_name,
					"lastName"=>$this->currentProfile->last_name,
					"homeLink"=>$this->homeLink,
					"CLIENT_BASE_URL"=>CLIENT_BASE_URL
			
			));
		}else{
			
			$manuItems[] = new MenuItemTemplate('menuButtonProfile', array(
					"profileImage"=>BASE_URL."images/user_male.png",
					"firstName"=>$this->user->username,
					"lastName"=>"",
					"homeLink"=>$this->homeLink,
					"CLIENT_BASE_URL"=>CLIENT_BASE_URL
			
			));
		}
		
		if($this->user->user_level == "Admin"){
			$manuItems[] = new MenuItemTemplate('menuButtonHelp', array(
					"APP_NAME"=>APP_NAME,
					"VERSION"=>VERSION,
					"VERSION_DATE"=>VERSION_DATE
			));
		}
		
		return $manuItems;
		
	}
	
	public function getMenuItemsHTML(){
		$menuItems = $this->getMenuBlocks();
		$menuHtml = "";
		foreach($menuItems as $item){
			$menuHtml.=$item->getHtml();
		}
		
		return $menuHtml;
	}
	
}



//Menu Items

class MenuItemTemplate{

	public $templateName;
	public $params;
	
	public function __construct($templateName, $params){
		$this->templateName = $templateName;
		$this->params = $params;
	}
	
	public function getHtml(){
		return UIManager::getInstance()->populateTemplate($this->templateName, 'menu', $this->params);
	}
	
}






