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

	class CmsDatabase
	{
		private $server;
		private $name;		
		private $username;
		private $password;
		public $errorMessage;
		public $insertID;
		
		function __construct($server, $name, $username, $password) {
			$this->server = $server;
			$this->name = $name;
			$this->username = $username;
			$this->password = $password;
		}
				
		public function Query($sql)
		{
			$con = mysql_connect($this->server, $this->username, $this->password);
				
			if ($con) {
				mysql_select_db($this->name, $con);					
				$result = mysql_query($sql);
				$this->errorMessage = mysql_error($con);	
				$this->insertID = mysql_insert_id($con);
				mysql_close($con);
				return $result;
			} 
		}		
	}
?>
