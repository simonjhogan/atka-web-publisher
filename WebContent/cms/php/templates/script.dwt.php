	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/jquery.ui.css">
	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/jstree.ui.css">	
	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/cms.ui.css">
	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/cms.colorpicker.ui.css">	
	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/cms.inserttables.ui.css">	
	<link rel="stylesheet" type="text/css" href="/cms/styles/ui/cms.dialog.ui.css">		
		
	<script type="application/javascript" src="/cms/script/jquery.min.js"></script>
	<script type="application/javascript" src="/cms/script/jquery.ui.min.js"></script>
	<script type="application/javascript" src="/cms/script/jquery.cookies.min.js"></script>	
	<script type="application/javascript" src="/cms/script/jquery.jstree.js"></script>	
	<script type="application/javascript" src="/cms/script/cms.core.js"></script>
	<script type="application/javascript" src="/cms/script/cms.dialog.js"></script>

	<script type="text/javascript">
		<?php 
			echo "\tvar _cms_assets_path = '".CMS_FILE_PATH."';\n"; 
			echo "\t\t\tvar _cms_index_path = '".CMS_INDEX_PATH."';\n";			
			echo "\t\t\tvar _cms_content_id = '".$this->id."';\n";
			echo "\t\t\tvar _cms_user_fullname = '".$this->fullname."';\n";
			if ($this->demoMode) {
				echo "\t\t\tvar _cms_demo_mode = true;\n";	
			}			
		?>
	</script>
	