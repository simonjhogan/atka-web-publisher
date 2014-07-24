<?php
/**
ATKA Web Publisher

Copyright 2014 Simon J. Hogan (Sith'ari Consulting)

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this 
file except in compliance with the License. You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under 
the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, 
either express or implied. See the License for the specific language governing permissions 
and limitations under the License.
**/

	class CmsSession
	{
		private $currentDirectory;
		public $user;	
		public $demo;
					
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;
			$this->user = new CmsUser($currentDirectory);			
			session_start();
		}	
		
		function Login()
		{
			if ($this->user->Authenticate()) {
				$_SESSION['_cms_username'] = $this->user->Username();
				$_SESSION['_cms_fullname'] = $this->user->Fullname();				
				$_SESSION['_cms_key'] = $this->user->Key();
				return true;
			}
			return false;
		}
		
		function Logout()
		{
			session_destroy();
		}
		
		function Authenticated()
		{
			if (isset($_SESSION['_cms_key'])) {
				if (strlen($_SESSION['_cms_key']) == 64) {
					if ($this->user->GetUserByKey($_SESSION['_cms_key'])) {
						return true;
					}
				}
			}
			return false;
		}
		
		function Demo()
		{
			return $this->demo;
		}
	}
?>
