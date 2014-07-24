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

	$cwd = getcwd();	
	ob_start();
	include($cwd."/resources/templates/home.dwt");
	$template = ob_get_contents();
	ob_end_clean();
	
	preg_match_all('<!-- #BeginEditable "(.*)" -->', $template, $result, PREG_PATTERN_ORDER);
	
	for ($i = 0; $i < count($result[1]); $i++) {
		$field = '/<!-- #BeginEditable "'.$result[1][$i].'" -->.*?<!-- #EndEditable -->/s';
		
		if ($result[1][$i] == "doctitle") {
			$template = preg_replace($field, "<title>".$result[1][$i]."</title>", $template);
		} else {
			$template = preg_replace($field, "<div class=\"cms-editable\" contenteditable=\"true\">".$result[1][$i]."</div>", $template);
		}
	}
	
	echo $template;
?>
