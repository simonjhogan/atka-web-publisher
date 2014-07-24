<?php
	//Database settings
	define(CMS_DB_SERVER, "localhost");
	define(CMS_DB_DATABASE, "content");
	define(CMS_DB_USERNAME, "user");
	define(CMS_DB_PASSWORD, "password");

	define(CMS_LIBRARY_PATH, "/path/cms");
	define(CMS_TEMPLATE_PATH, "/path/templates");		
	define(CMS_FILE_PATH, "/path");
	define(CMS_INDEX_PATH, "/index.php");	
	define(CMS_SPELL_LANGUAGE, "en");	
				
	//Force cookies for session control
	ini_set('session.use_trans_sid', false); 
	ini_set('session.use_only_cookies', true); 
	ini_set('url_rewriter.tags', ''); 
	
	//Autoload class files
	function __autoload($name) {
		switch($name) {
			case "CMS":
				include CMS_LIBRARY_PATH."/php/cms.class.php";
				break;
				
			default:
	    		include CMS_LIBRARY_PATH."/php/".strtolower(substr($name, 3)).".class.php";
	    		break;
	    }
	}			
?>
