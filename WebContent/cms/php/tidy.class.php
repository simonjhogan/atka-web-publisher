<?php
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