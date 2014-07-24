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

	class CmsTidy
	{
		private $currentDirectory;
					
		function __construct($currentDirectory) 
		{
			$this->currentDirectory = $currentDirectory;		
		}
		
		function Repair($html, $options = null)
		{
			$original = array();
			$clean = array();
			$config = array();
			
			if (is_null($options)) {
				$config["clean"] = true;
				$config["word-2000"] = true;
				$config["drop-proprietary-attributes"] = true;
				$config["fix-backslash"] = true;
			} else {
				foreach($config as $c) {
					$config[$c] = true;
				}
			}
			
			$tidy = new tidy();
			
			foreach($html as $h) {
				$tidy->parseString(stripslashes($h), $config, "UTF8");
				$tidy->cleanRepair();
				$code = $tidy->Body()->value;
				$start = strpos($code, ">")+1;
				$length = strrpos($code, "<") - $start;
				$original[] = $h;
				$clean[] = substr($code, $start, $length);
			}
			
			return array("clean" => $clean, "original" => $original);
		}
	}
?>