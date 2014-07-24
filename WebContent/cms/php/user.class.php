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

	class CmsUser
	{
		private $currentDirectory;
		private $database;
		private $user;	
					
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;
			$this->database = new CmsDatabase(CMS_DB_SERVER, CMS_DB_DATABASE, CMS_DB_USERNAME, CMS_DB_PASSWORD);
		}	
		
		function Authenticate()
		{
			if (isset($_POST['cms-username']) & isset($_POST['cms-password'])) {
				if (strlen($_POST['cms-username']) > 0 & strlen($_POST['cms-password']) > 0) {
					return $this->GetUser($_POST['cms-username'], $_POST['cms-password']);	
				}
			}
			return false;
		}

		function GetUser($username, $password)
		{

			//Get Hashed Password					
			$salt = $this->GetSalt($username);
			if ($salt === false) {
				return false;
			}
			$hash = $this->HashedPassword($password, $salt);
			
			//Check for User
			$result = $this->database->Query("SELECT * FROM users WHERE users.username = '".$username."' AND users.password = '".$hash."' LIMIT 1");
			if (mysql_num_rows($result) == 1) {
				$this->user = mysql_fetch_object($result);
				//To Do: Update user with login date & time
				return true;
			}
			return false;
		}

		function GetSalt($username)
		{
			$result = $this->database->Query("SELECT salt FROM users WHERE users.username = '".$username."'");
			if (mysql_num_rows($result) == 1) {
				return mysql_fetch_object($result)->salt;
			}
			return false;
		}

		function View()
		{
			$return = array();
			$result = $this->database->Query("SELECT * FROM users ORDER BY username ASC");
			
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
				$this->database->Query("DELETE FROM users WHERE id='$value'");
			}
			
			return true;	
		}

		function Create()
		{
			$key = $this->GUID();
			$salt = $this->GUID();
			
			//Hash Password
			$password = $_POST['password'];
			if ($password != $_POST['confirm-password']) {
				return false;
			}
			$hash = $this->HashedPassword($password, $salt);
			
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$role = $_POST['role'];
								
			//Insert User
			$sql = "INSERT INTO users (users.key, username, firstname, lastname, fullname, email, role, salt, password, created, modified) VALUES ('$key', '$username', '$firstname', '$lastname', '$fullname', '$email', '$role', '$salt', '$hash', NOW(), NOW())";

			if ($this->database->Query($sql)) {
				return true;
			} else {
				$this->errorMessage = $this->database->errorMessage;
				return false;
			}
			
			return false;
		}

		function ChangePassword()
		{
			//GetSalt
		}

		function GUID()
		{
			return hash("sha256", uniqid('', true));
		}

		function HashedPassword($password, $salt)
		{
			if (CRYPT_SHA512 == 1) {
				return crypt($password, '$6$rounds=5000$' . $salt . '$');
			}
			return false;
		}

		function GetUserByKey($key)
		{
			if (strlen($key) > 0) {
				$result = $this->database->Query("SELECT * FROM users WHERE users.key = '".$key."' LIMIT 1");
				if (mysql_num_rows($result) == 1) {
					$this->user = mysql_fetch_object($result);
					return true;
				}
			}
			return false;
		}

		function Exists($username)
		{
			if (strlen($username) > 0) {
				$result = $this->database->Query("SELECT * FROM users WHERE users.username = '".$username."' LIMIT 1");
				if (mysql_num_rows($result) == 1) {
					return true;
				}
			}
			return false;
		}

		function Username()
		{
			return $this->user->username;
		}
		
		function Firstname()
		{
			return $this->user->firstname;
		}
		
		function Lastname()
		{
			return $this->user->lastname;
		}

		function Fullname()
		{
			return $this->user->fullname;
		}

		function Email()
		{
			return $this->user->email;
		}

		function Key()
		{
			return $this->user->key;
		}

	}
?>
