<?php
	class CmsPage 
	{
		private $currentDirectory;
		private $database;
		public $errorMessage;
							
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;
			$this->database = new CmsDatabase(CMS_DB_SERVER, CMS_DB_DATABASE, CMS_DB_USERNAME, CMS_DB_PASSWORD);
		}	

		function Load($path)
		{
			if (strlen($path) > 0) {
				$result = $this->database->Query("SELECT * FROM pages WHERE pages.ref = '$path' LIMIT 1");
			} else {	
				$result = $this->database->Query("SELECT * FROM pages WHERE pages.default = true LIMIT 1");
			}		
			return mysql_fetch_object($result);
		}

		function View($path)
		{
			if ($path == "") {
				$path = "/";
			}
			$return = array();
			$result = $this->database->Query("SELECT id, ref, title, template, created, modified FROM pages WHERE path = '$path' ORDER BY ref ASC, title ASC");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}

		function ViewPaths()
		{
			$return = array();
			$result = $this->database->Query("SELECT DISTINCT path FROM pages WHERE path <> '/' ORDER BY path ASC");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}
		
		function Save($path)
		{	
			//Create Revision
			if (strlen($path) > 0) {
				$sql = "INSERT revisions SELECT * FROM pages WHERE ref = '$path'";
			} else {	
				$sql = "INSERT revisions SELECT * FROM pages WHERE pages.default = true";
			}

			$this->database->Query($sql);
			$this->errorMessage = $this->database->errorMessage;		
		
			$sqlfields = array();
			foreach($_POST as $field=>$value) {
				$sqlfields[] = $field."='".$value."'";
			}
			$sqlfields[] = "modified=NOW()";
			
			$fields = implode(", ", $sqlfields);
		
			if (strlen($path) > 0) {
				$sql = "UPDATE pages SET $fields WHERE ref = '$path'";
			} else {	
				$sql = "UPDATE pages SET $fields WHERE pages.default = true";
			}
	
			if ($this->database->Query($sql)) {
				$result = true;	
			} else {
				$this->errorMessage = $this->database->errorMessage;
				$result = false;
			}
			
			return	$result;	
		}
		
		function Create()
		{			
			$path = $_POST['ref'];
			if (strrpos($path, "/") == 0) {
				$path = "/";
			} else {
				$path = substr($path, 0, strrpos($path, "/"));
			}
			
			$sqlfields = array();
			$sqlvalues = array();
			foreach($_POST as $field=>$value) {
				$sqlfields[] = $field;
				$sqlvalues[] = "'".$value."'";
			}
			$fields = implode(", ", $sqlfields);
			$values = implode(", ", $sqlvalues);
		
			$sql = "INSERT INTO pages ($fields, path, created, modified) VALUES ($values, '$path', NOW(), NOW())";

	
			if ($this->database->Query($sql)) {
				$result = $_POST['ref'];	
			} else {
				$this->errorMessage = $this->database->errorMessage;
				$result = false;
			}
			
			return	$result;	
		}
		
		function Delete($idList)
		{
			$sqlid = array();
			$id = explode(",", $idList);
			
			foreach($id as $value) {
				$this->database->Query("DELETE FROM pages WHERE id='$value'");
			}
			
			return true;	
		}
		
		function SetTemplate($id, $template)
		{		
			$sql = "UPDATE pages SET template='$template' WHERE id = $id";
	
			if ($this->database->Query($sql)) {
				$result = true;	
			} else {
				$this->errorMessage = $this->database->errorMessage;
				$result = false;
			}
			
			return	$result;			
		}
		
		function SetHomepage($id, $template)
		{	
			$result = false;	
			$sql = "UPDATE pages SET pages.default=false WHERE pages.default=true";
			if ($this->database->Query($sql)) {
				$sql = "UPDATE pages SET pages.default=true WHERE id = $id";
	
				if ($this->database->Query($sql)) {
					$result = true;	
				}
			}
			
			$this->errorMessage = $this->database->errorMessage;	
			return	$result;			
		}
		
	}
?>
