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

class ProfilesActionManager extends SubActionManager{
	public function get($req){
		
		$profile = $this->baseService->getElement('Profile',$this->getCurrentProfileId(),$req->map,true);	
		
		$subordinate = new Profile();
		$subordinates = $subordinate->Find("supervisor = ?",array($profile->id));
		$profile->subordinates = $subordinates;
		
		$fs = new FileService();
		$profile = $fs->updateProfileImage($profile);
		
		if(!empty($profile->birthday)){
			$profile->birthday = date("F jS, Y",strtotime($profile->birthday));
		}
		
		if(empty($profile->id)){
			return new IceResponse(IceResponse::ERROR,$profile);		
		}
		return new IceResponse(IceResponse::SUCCESS,$profile);
	}
	
	public function deleteProfileImage($req){
		if($this->user->user_level == 'Admin' || $this->user->profile == $req->id){
			$fs = new FileService();
			$res = $fs->deleteProfileImage($req->id);
			return new IceResponse(IceResponse::SUCCESS,$res);	
		}
	}
}