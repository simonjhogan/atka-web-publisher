	<div id="cms-insert-dialog" class="cms-content cms-dialog" title="Insert Dialog" style="display: none;">
		<div id="cms-dialog-alert" style="display: none;"></div>
		<div class="cms-list">
			<div class="cms-list-tree">
				<div class="cms-list-content"></div>
			</div>	
			<div class="cms-list-view">
				<div id="cms-list-data"></div>
			</div>
			<div class="cms-clear"></div>
		</div>

		<!--New Page Form-->
		<form method="post" action="/index.php/_cms/page/new" id="cms-new-page-form" class="cms-form" style="display: none;">
			<table class="cms-form-table">			
				<tr>
					<td width="35"><label class="cms-label" for="cms-page-url">Url:</label></td>
					<td width="*"><input type="text" id="cms-page-url" name="ref" class="cms-input text ui-widget-content ui-corner-all" value="/newpage" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-link-title">Template:</label></td>
					<td width="*">
						<select id="cms-page-template" name="template" class="cms-input text ui-widget-content ui-corner-all" required="required">
							<?php
								$templates = new CmsTemplate($this->currentDirectory);
								$templateList = $templates->ViewAll();
								foreach($templateList as $template) {
									echo "<option value=\"".$template->name."\">".$template->title."</option>\n";
								}
							?>
						</select>
					</td>
				</tr>				
				<tr>
					<td width="35"><label class="cms-label" for="cms-link-title">Title:</label></td>
					<td width="*"><input type="text" id="cms-page-title" name="title" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-page-description">Description:</label></td>
					<td width="*"><input type="text" id="cms-page-description" name="description" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>	
				<tr>
					<td width="35"><label class="cms-label" for="cms-page-keywords">Keywords:</label></td>
					<td width="*"><input type="text" id="cms-page-keywords" name="keywords" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-page-author">Author:</label></td>
					<td width="*"><input type="text" id="cms-page-author" name="author" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>																	
			</table>
		</form>	
				
		<!--Insert Page Link Form-->
		<form id="cms-insert-link-form" class="cms-form" style="display: none;">
			<table class="cms-form-table">
				<tr>
					<td width="35"><label class="cms-label" for="cms-link-url">Url:</label></td>
					<td width="*"><input type="text" id="cms-link-url" name="cms-link-url" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-link-text">Text:</label></td>
					<td width="*"><input type="text" id="cms-link-text" name="cms-link-text" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>				
			</table>
		</form>	

		<!--Insert File Link Form-->
		<form id="cms-insert-file-link-form" class="cms-form" style="display: none;">
			<table class="cms-form-table">
				<tr>
					<td width="35"><label class="cms-label" for="cms-file-url">Url:</label></td>
					<td width="*"><input type="text" id="cms-file-url" name="cms-file-url" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-file-text">Text:</label></td>
					<td width="*"><input type="text" id="cms-file-text" name="cms-file-text" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>				
			</table>
		</form>	

		<!--Insert Video/Audio Form-->
		<form id="cms-insert-media-form" class="cms-form" style="display: none;">
			<table class="cms-form-table">
				<tr>
					<td width="35"><label class="cms-label" for="cms-media-url">Url:</label></td>
					<td width="*"><input type="text" id="cms-media-url" name="cms-media-url" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-media-filetype">Filetype:</label></td>
					<td width="*"><input type="text" id="cms-media-filetype" name="cms-media-filetype" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>																
			</table>
		</form>	

		<!--Insert Image Form-->
		<form id="cms-insert-image-form" class="cms-form" style="display: none;">
			<table class="cms-form-table">
				<tr>
					<td width="35"><label class="cms-label" for="cms-image-url">Url:</label></td>
					<td width="*"><input type="text" id="cms-image-url" name="cms-image-url" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td width="35"><label class="cms-label" for="cms-image-alt">Alt:</label></td>
					<td width="*"><input type="text" id="cms-image-alt" name="cms-image-alt" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
			</table>
			<table class="cms-form-table">
				<tr>
					<td width="35"><label class="cms-label" for="cms-image-width">Width:</label></td>
					<td width="*"><input type="text" id="cms-image-width" name="cms-image-width" class="cms-input text ui-widget-content ui-corner-all"></td>
					<td width="35"><label class="cms-label" for="cms-image-height">Height:</label></td>
					<td width="*"><input type="text" id="cms-image-height" name="cms-image-height" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>
				
			</table>
		</form>	

		<!--Upload File Form-->
		<form id="cms-upload-file-form" class="cms-form" target="cms-upload-iframe" method="post" enctype="multipart/form-data" action="/index.php/_cms/file/new" style="display: none;">
			<table class="cms-form-table">
				<tr>
					<td><label class="cms-label" for="cms-upload-title">Path:</label></td>
					<td><input type="text" id="cms-upload-path" name="cms-upload-path" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>														
				<tr>
					<td width="35"><label class="cms-label" for="cms-upload-file">File:</label></td>
					<td width="*"><input type="file" id="cms-upload-file" name="cms-upload" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>	
				<tr>
					<td><label class="cms-label" for="cms-upload-title">Title:</label></td>
					<td><input type="text" id="cms-upload-title" name="cms-upload-title" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-upload-description">Description:</label></td>
					<td><input type="text" id="cms-upload-description" name="cms-upload-description" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>				
				<tr>
					<td><label class="cms-label" for="cms-upload-category">Category:</label></td>
					<td><input type="text" id="cms-upload-category" name="cms-upload-category" class="cms-input text ui-widget-content ui-corner-all"></td>
				</tr>																
			</table>
		</form>			
		<iframe id="cms-upload-iframe" style="display: none;"></iframe>				
	</div>

	<!--HTML Dialog-->
	<div id="cms-html-editor-dialog" class="cms-content cms-dialog" title="HTML Editor" style="display: none;">
		<form id="cms-html-editor-form">
			<textarea id="cms-html-editor" name="cms-html-editor" class="text ui-widget-content ui-corner-all"></textarea>
		</form>
	</div>
	
	<!--Template Change Dialog-->
	<div id="cms-select-template-dialog" class="cms-content cms-dialog" title="Select Page Template" style="display: none;">
		<form id="cms-select-template-form" class="cms-form">
			<table class="cms-form-table">			
				<tr>
					<td width="90"><label class="cms-label" for="cms-link-title">Page Template:</label></td>
					<td width="*">
						<select id="cms-select-template" name="template" class="cms-input text ui-widget-content ui-corner-all" required="required">
							<?php
								foreach($templateList as $template) {
									echo "<option value=\"".$template->name."\">".$template->title."</option>\n";
								}
							?>
						</select>
					</td>
				</tr>	
			</table>
		</form>
	</div>
	
	<!--Spell Check Dialog-->
	<div id="cms-spell-checker-dialog" class="cms-content cms-dialog" title="Spelling Checker" style="display: none;">
		<form id="cms-spell-checker-form" class="cms-form">
			<table class="cms-form-table">
				<tr>
					<td width="100%"><label class="cms-label" for="cms-spelling-word">Not in dictionary:</label></td>
				</tr>
				<tr>
					<td width="100%">
						<input type="hidden" id="cms-spelling-word-hidden" name="suggest-hidden">
						<input type="text" id="cms-spelling-word" name="suggest" class="cms-input text ui-widget-content ui-corner-all">
					</td>
				</tr>						
				<tr>
					<td width="100%"><label class="cms-label" for="cms-spelling-suggest">Suggestions:</label></td>
				</tr>
				<tr>
					<td width="100%">
						<select id="cms-spelling-suggest" name="suggest" class="cms-input text ui-widget-content ui-corner-all" multiple="multiple">
						</select>
					</td>
				</tr>	
			</table>
		</form>
	</div>
	
	<!--Link Check Dialog-->
	<div id="cms-link-checker-dialog" class="cms-content cms-dialog" title="Link Checker" style="display: none;">
		<div id="cms-link-view">
			<table></table>
		</div>
	</div>
	
	<!--HTML Tidy Dialog-->
	<div id="cms-html-tidy-dialog" class="cms-content cms-dialog" title="HTML Tidy Options" style="display: none;">
		<div id="cms-tidy-view">
			<form id="cms-html-tidy-form" class="cms-form">
				<table class="cms-form-table">
					<tr>
						<td><label class="cms-label">clean</label></td>
						<td><input type="checkbox" name="options[]" value="clean" checked="checked"></td>
					</tr>
					<tr>
						<td><label class="cms-label">word-2000</label></td>
						<td><input type="checkbox" name="options[]" value="word-2000" checked="checked"></td>
					</tr>
					<tr>
						<td><label class="cms-label">quote-marks</label></td>
						<td><input type="checkbox" name="options[]" value="quote-marks"></td>
					</tr>
					<tr>
						<td><label class="cms-label">drop-proprietary-attributes</label></td>
						<td><input type="checkbox" name="options[]" value="drop-proprietary-attributes" checked="checked"></td>
					</tr>	
					<tr>
						<td><label class="cms-label">bare</label></td>
						<td><input type="checkbox" name="options[]" value="bare" checked="checked"></td>
					</tr>
					<tr>
						<td><label class="cms-label">drop-empty-paras</label></td>
						<td><input type="checkbox" name="options[]" value="drop-empty-paras" checked="checked"></td>
					</tr>
					<tr>
						<td><label class="cms-label">drop-font-tags</label></td>
						<td><input type="checkbox" name="options[]" value="drop-font-tags" checked="checked"></td>
					</tr>
					<tr>
						<td><label class="cms-label">fix-uri</label></td>
						<td><input type="checkbox" name="options[]" value="fix-uri" checked="checked"></td>
					</tr>										
				</table>
			</form>
		</div>
	</div>
	
	<!--View Users Dialog-->
	<div id="cms-view-users-dialog" class="cms-content cms-dialog" title="Site Users View" style="display: none;">
		<input type="hidden" id="cms-user-count" name="cms-user-count" value="">
		<div id="cms-users-view">
		</div>
	</div>
	
	<!--New User Dialog-->
	<div id="cms-new-user-dialog" class="cms-content cms-dialog" title="Create New User" style="display: none;">
		<form id="cms-new-user-form" class="cms-form">	
			<table class="cms-form-table">
				<tr>
					<td width="120"><label class="cms-label" for="cms-user">Username:</label></td>
					<td width="*"><input type="text" id="cms-user" title="Username" name="username" class="cms-input text ui-widget-content ui-corner-all" required="required" autocomplete="off"><span id="cms-user-exists"></span></td>
					<td width="18"></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-firstname">Firstname:</label></td>
					<td><input type="text" id="cms-firstname" title="Firstname" name="firstname" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
					<td></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-lastname">Lastname:</label></td>
					<td><input type="text" id="cms-lastname" title="Lastname" name="lastname" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
					<td></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-lastname">Fullname:</label></td>
					<td><input type="text" id="cms-fullname" title="Fullname" name="fullname" class="cms-input text ui-widget-content ui-corner-all"></td>
					<td></td>
				</tr>				
				<tr>
					<td><label class="cms-label" for="cms-email">Email:</label></td>
					<td><input type="text" id="cms-email" title="Email" name="email" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
					<td></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-role">Role:</label></td>
					<td>
						<select id="cms-role" name="role">
							<option value="admin">Administrator</option>
							<option value="author">Author</option>						
						</select>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-password">Password:</label></td>
					<td><input type="password" id="cms-password" title="Password" name="password" class="cms-input text ui-widget-content ui-corner-all" required="required"></td>
					<td></td>
				</tr>
				<tr>
					<td><label class="cms-label" for="cms-password-confirm">Confirm Password:</label></td>
					<td><input type="password" id="cms-password-confirm" title="Confirm Password" name="confirm-password" class="cms-input text ui-widget-content ui-corner-all" required="required"><span id="cms-pass-valid"></span></td>
					<td></td>
				</tr>	
			</table>
		</form>
	</div>
	
