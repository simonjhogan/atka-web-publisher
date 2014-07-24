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
