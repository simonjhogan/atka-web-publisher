<?php 
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
