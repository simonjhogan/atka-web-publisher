<?php
	class CmsFile 
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
				$result = $this->database->Query("SELECT * FROM files WHERE files.ref = '$path' LIMIT 1");
			} 		
			return mysql_fetch_object($result);
		}

		function View($path, $filetype)
		{
			if ($path == "") {
				$path = "/";
			}

			switch ($filetype) {
				case "media":
					$sqlfiletype = "AND (filetype LIKE 'video%' OR filetype LIKE 'audio%')";
					break;
				case "image":
					$sqlfiletype = "AND filetype LIKE 'image%'";
					break;					
			}
			
			$return = array();
			$result = $this->database->Query("SELECT id, ref, title, filetype, modified FROM files WHERE path = '$path' $sqlfiletype ORDER BY ref ASC");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}
		
		function Save()
		{
			if ($_FILES["cms-upload"]["error"] > 0) {
				$this->errorMessage = $_FILES["cms-upload"]["error"];
				return false;
			} else {	
				if ($_POST["cms-upload-path"] == "") {
					$ref = "/".$_FILES["cms-upload"]["name"];
					$path = "/";
				} else {
					$path = strtolower($_POST["cms-upload-path"]);
					$ref = $path."/".$_FILES["cms-upload"]["name"];
					if (!file_exists($this->currentDirectory.CMS_FILE_PATH.$path)) {
						mkdir($this->currentDirectory.CMS_FILE_PATH.$path, 0777, true);
					}
				}
				move_uploaded_file($_FILES["cms-upload"]["tmp_name"], $this->currentDirectory.CMS_FILE_PATH.$ref);
				
				$filetype = $_FILES["cms-upload"]["type"];
				$title = $_POST["cms-upload-title"];
				$description = $_POST["cms-upload-description"];					
				$category = $_POST["cms-upload-category"];				
				$size = $_FILES["cms-upload"]["size"];
				$metadata = "";
				
				if (strpos($filetype, "image") !== false) {
					$image = getimagesize($this->currentDirectory.CMS_FILE_PATH.$ref);
					$metadata = "width:".$image[0].",height:".$image[1];
				}
				
				if ($this->database->Query("INSERT INTO files (ref, path, filetype, title, description, category, size, metadata, created, modified) VALUES ('$ref', '$path', '$filetype', '$title', '$description', '$category', $size, '$metadata', NOW(), NOW())")) {
					$result = "File uploaded: ".CMS_FILE_PATH.$ref;	
				} else {
					$this->errorMessage = $this->database->errorMessage;
					$result = false;
				}
			}
			return $result;
		}

		function ViewPaths($path, $filetype, $limit)
		{
			if ($limit != "") {
				$sqllimit = "LIMIT $limit";
			}
			
			switch ($filetype) {
				case "media":
					$sqlfiletype = "AND (filetype LIKE 'video%' OR filetype LIKE 'audio%')";
					break;
				case "image":
					$sqlfiletype = "AND filetype LIKE 'image%'";
					break;					
			}	
				
			$return = array();
			$result = $this->database->Query("SELECT DISTINCT path FROM files WHERE path <> '/' AND path LIKE '$path%' $sqlfiletype ORDER BY path ASC $sqllimit");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}

		function ViewCategories($category)
		{
			$return = array();
			$result = $this->database->Query("SELECT DISTINCT category FROM files WHERE category LIKE '$category%' ORDER BY category ASC LIMIT 10");
			
			while ($row = mysql_fetch_object($result)) {
				$return[] = $row;			
			}

			return $return;
		}

		function Delete($idList)
		{
			$sqlid = array();
			$id = explode(",", $idList);
			
			foreach($id as $value) {
				$this->DeleteFile($value);
			}
			
			return true;	
		}
		
		function DeleteFile($id)
		{
			$result = $this->database->Query("SELECT ref FROM files WHERE id='$id'");
			$row = mysql_fetch_object($result);
			unlink($this->currentDirectory.CMS_FILE_PATH.$row->ref);
			$row = $this->database->Query("DELETE FROM files WHERE id='$id'");			
		}
	}
?>
