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

class UsersActionManager extends SubActionManager{
	public function changePassword($req){
		if($this->user->user_level == 'Admin' || $this->user->id == $req->id){
			$user = $this->baseService->getElement('User',$req->id);
			if(empty($user->id)){
				return new IceResponse(IceResponse::ERROR,"Please save the user first");
			}	
			$user->password = md5($req->pwd);
			$ok = $user->Save();
			if(!$ok){
				return new IceResponse(IceResponse::ERROR,$user->ErrorMsg());		
			}
			return new IceResponse(IceResponse::SUCCESS,$user);
		}
		return new IceResponse(IceResponse::ERROR);
	}
	
	public function saveUser($req){
		$profileVar = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
		$profileClass = ucfirst(SIGN_IN_ELEMENT_MAPPING_FIELD_NAME);
		if($this->user->user_level == 'Admin'){
			
			$user = new User();
			$user->Load("email = ?",array($req->email));
			
			if($user->email == $req->email){
				return new IceResponse(IceResponse::ERROR,"User with same email already exists");
			}
			
			$user->Load("username = ?",array($req->username));
			
			if($user->username == $req->username){
				return new IceResponse(IceResponse::ERROR,"User with same username already exists");
			}
			
			$user = new User();
			$user->email = $req->email;
			$user->username = $req->username;
			$password = $this->generateRandomString(6);
			$user->password = md5($password);
			$user->profile = (empty($req->profile) || $req->profile == "NULL" )?NULL:$req->profile;
			$user->user_level = $req->user_level;
			$user->last_login = date("Y-m-d H:i:s");
			$user->last_update = date("Y-m-d H:i:s");
			$user->created = date("Y-m-d H:i:s");
			
			$profile = null;
			if(!empty($user->profile)){
				$profile = $this->baseService->getElement($profileClass,$user->profile,null,true);
			}
			
			$ok = $user->Save();
			if(!$ok){
				LogManager::getInstance()->info($user->ErrorMsg()."|".json_encode($user));
				return new IceResponse(IceResponse::ERROR,"Error occured while saving the user");
			}
			$user->password = "";
			$user = $this->baseService->cleanUpAdoDB($user);
			
			if(!empty($this->emailSender)){
				$usersEmailSender = new UsersEmailSender($this->emailSender, $this);
				$usersEmailSender->sendWelcomeUserEmail($user, $password, $profile);
			}
			return new IceResponse(IceResponse::SUCCESS,$user);
		}
		return new IceResponse(IceResponse::ERROR, "Not Allowed");
	}
	
	
	private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}