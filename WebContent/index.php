<?php
/*
 * h3consulting
 * Simon J. Hogan
 * 2012/05/07
 */
	require(getcwd()."/config.php");	
	$control = new CmsControl(getcwd());
	$control->Process();
?>
