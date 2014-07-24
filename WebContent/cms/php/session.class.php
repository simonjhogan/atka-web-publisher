<?php
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
