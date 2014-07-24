<?php
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
