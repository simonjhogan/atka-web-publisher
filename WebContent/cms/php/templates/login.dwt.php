	<div id="cms-login-dialog" class="cms-content" title="h3cms Administration Login" style="display: none;">
		<form id="cms-login-form" action="<?php echo $_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?authenticate"; ?>" method="post">
			<label class="cms-label" for="cms-username">Username</label>
			<input id="cms-username" name="cms-username" type="text" class="text ui-widget-content ui-corner-all" value="">
			<label class="cms-label" for="cms-password">Password</label>
			<input id="cms-password" name="cms-password" type="password" class="text ui-widget-content ui-corner-all" value="">
		</form>
	</div>
