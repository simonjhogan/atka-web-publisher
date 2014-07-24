<?php
	class CMS
	{
		private $currentDirectory;
		public $demoMode = false;
		public $fullname = "";
		public $id = "";		
							
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;				
		}

		function ControlScript() {		
			include(CMS_LIBRARY_PATH."/php/templates/script.dwt.php");
		}
		
		function ControlRibbon() {		
			include(CMS_LIBRARY_PATH."/php/templates/ribbon.dwt.php");
			include(CMS_LIBRARY_PATH."/php/templates/colorpicker.dwt.php");
			include(CMS_LIBRARY_PATH."/php/templates/tables.dwt.php");								
			include(CMS_LIBRARY_PATH."/php/templates/dialogs.dwt.php");									
		}

		function LoginDialog() {		
			include(CMS_LIBRARY_PATH."/php/templates/login.dwt.php");
		}

	}
?>
