<?php
	class CmsTemplate
	{
		private $currentDirectory;
		private $database;
							
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;
			$this->database = new CmsDatabase(CMS_DB_SERVER, CMS_DB_DATABASE, CMS_DB_USERNAME, CMS_DB_PASSWORD);
		}	

		function ViewAll()
		{
			if ($path == "") {
				$path = "/";
			}
			$return = array();
			$result = $this->database->Query("SELECT title, name FROM templates");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}
	}
?>
