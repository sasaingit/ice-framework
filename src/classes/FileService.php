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

class FileService{
	
	private static $me = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
		if(empty(self::$me)){
			self::$me = new FileService();
		}
	
		return self::$me;
	}
	
	public function updateProfileImage($profile){
		$file = new File();
		$file->Load('name = ?',array('profile_image_'.$profile->id));
		
		if($file->name == 'profile_image_'.$profile->id){
			$uploadFilesToS3 = SettingsManager::getInstance()->getSetting("Files: Upload Files to S3");	
			if($uploadFilesToS3 == "1"){
				$uploadFilesToS3Key = SettingsManager::getInstance()->getSetting("Files: Amazon S3 Key for File Upload");
				$uploadFilesToS3Secret = SettingsManager::getInstance()->getSetting("Files: Amazone S3 Secret for File Upload");
				$s3FileSys = new S3FileSystem($uploadFilesToS3Key, $uploadFilesToS3Secret);
				$s3WebUrl = SettingsManager::getInstance()->getSetting("Files: S3 Web Url");
				$fileUrl = $s3WebUrl.CLIENT_NAME."/".$file->filename;
				$fileUrl = $s3FileSys->generateExpiringURL($fileUrl);
				$profile->image = $fileUrl;
			}else{
				$profile->image = CLIENT_BASE_URL.'data/'.$file->filename;
			}
			
		}else{
			if($profile->gender == 'Female'){
				$profile->image = BASE_URL."images/user_female.png";			
			}else{
				$profile->image = BASE_URL."images/user_male.png";	
			}
		}

		return $profile;
	}
	
	public function getFileUrl($fileName){
		$file = new File();
		$file->Load('name = ?',array($fileName));
	
		$uploadFilesToS3 = SettingsManager::getInstance()->getSetting("Files: Upload Files to S3");
		
		if($uploadFilesToS3 == "1"){
			$uploadFilesToS3Key = SettingsManager::getInstance()->getSetting("Files: Amazon S3 Key for File Upload");
			$uploadFilesToS3Secret = SettingsManager::getInstance()->getSetting("Files: Amazone S3 Secret for File Upload");
			$s3FileSys = new S3FileSystem($uploadFilesToS3Key, $uploadFilesToS3Secret);
			$s3WebUrl = SettingsManager::getInstance()->getSetting("Files: S3 Web Url");
			$fileUrl = $s3WebUrl.CLIENT_NAME."/".$file->filename;
			$fileUrl = $s3FileSys->generateExpiringURL($fileUrl);
			return $fileUrl;
		}else{
			return  CLIENT_BASE_URL.'data/'.$file->filename;
		}
	}
	
	public function deleteProfileImage($profileId){
		$file = new File();
		$file->Load('name = ?',array('profile_image_'.$profileId));
		if($file->name == 'profile_image_'.$profileId){
			$ok = $file->Delete();	
			if($ok){
				LogManager::getInstance()->info("Delete File:".CLIENT_BASE_PATH.$file->filename);
				unlink(CLIENT_BASE_PATH.'data/'.$file->filename);		
			}else{
				return false;
			}	
		}	
		return true;
	}
	
	public function deleteFileByField($value, $field){
		LogManager::getInstance()->info("Delete file by field: $field / value: $value");
		$file = new File();
		$file->Load("$field = ?",array($value));
		if($file->$field == $value){
			$ok = $file->Delete();
			if($ok){			
				$uploadFilesToS3 = SettingsManager::getInstance()->getSetting("Files: Upload Files to S3");
				
				if($uploadFilesToS3 == "1"){
					$uploadFilesToS3Key = SettingsManager::getInstance()->getSetting("Files: Amazon S3 Key for File Upload");
					$uploadFilesToS3Secret = SettingsManager::getInstance()->getSetting("Files: Amazone S3 Secret for File Upload");
					$s3Bucket = SettingsManager::getInstance()->getSetting("Files: S3 Bucket");
					
					$uploadname = CLIENT_NAME."/".$file->filename;
					LogManager::getInstance()->info("Delete from S3:".$uploadname);
					
					$s3FileSys = new S3FileSystem($uploadFilesToS3Key, $uploadFilesToS3Secret);
					$res = $s3FileSys->deleteObject($s3Bucket, $uploadname);
						
				}else{
					LogManager::getInstance()->info("Delete:".CLIENT_BASE_PATH.'data/'.$file->filename);
					unlink(CLIENT_BASE_PATH.'data/'.$file->filename);
				}
				
				
			}else{
				return false;
			}
		}
		return true;
	}
}