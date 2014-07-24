	<div id="cms-controls" class="cms-content" style="display: none;">	
		<div id="cms-ribbon">
			<div id="cms-access"></div>
			<div id="cms-username"><?php echo $this->fullname ?></div>
			<ul class="cms-ribbon-tabs">
				<li id="cms-ribbon-page-tab"><a href="#cms-ribbon-page">Page</a></li>			
				<li id="cms-ribbon-format-tab"><a href="#cms-ribbon-format">Format Text</a></li>	
				<li id="cms-ribbon-insert-tab"><a href="#cms-ribbon-insert">Insert</a></li>
				<li id="cms-ribbon-tools-tab"><a href="#cms-ribbon-tools">Tools</a></li>	
				<li id="cms-ribbon-files-tab"><a href="#cms-ribbon-files">Files</a></li>					
				<li id="cms-ribbon-session-tab"><a href="#cms-ribbon-session">Session</a></li>								
			</ul>
			<div id="cms-ribbon-page" class="cms-ribbon-bar">
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-edit"><a href="javascript:;" onclick="cms.command(this);" title="Edit" data-enabled="edit"><span class="cms-icon"></span>Edit</a></li>	
						<li class="cms-ribbon-button-large cms-button-save" style="display: none;"><a href="javascript:;" onclick="cms.command(this);" title="Save & Close" data-enabled="edit"><span class="cms-icon"></span>Save &amp; Close</a></li>			
					</ul>
					<h3 class="cms-ribbon-group-label">Edit</h3>
				</div>
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-editmeta"><a href="javascript:;" onclick="cms.command(this);" title="Edit Properties" data-enabled="edit"><span class="cms-icon"></span>Edit<br>Properties</a></li>	
						<li class="cms-ribbon-button-large cms-button-deletepage"><a href="javascript:;" onclick="cms.command(this);" title="Delete Page"><span class="cms-icon"></span>Delete Page</a></li>	
						<li class="cms-ribbon-button-large cms-button-homepage"><a href="javascript:;" onclick="cms.command(this);" title="Make Homepage" data-enabled="edit"><span class="cms-icon"></span>Make<br>Homepage</a></li>	
						<li class="cms-ribbon-button-large cms-button-pagetemplate"><a href="javascript:;" onclick="cms.command(this);" title="Page Template"><span class="cms-icon"></span>Page Template</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Manage</h3>
				</div>					
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-newpage"><a href="javascript:;" onclick="cms.command(this);" title="New Page" data-enabled="edit"><span class="cms-icon"></span>New Page</a></li>			
						<li class="cms-ribbon-button-large cms-button-viewallpages"><a href="javascript:;" onclick="cms.command(this);" title="View All Pages" data-enabled="edit"><span class="cms-icon"></span>View All<br>Pages</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Page Library</h3>
				</div>				
				<div class="cms-clear"></div>	
			</div>			
			<div id="cms-ribbon-format" class="cms-ribbon-bar">
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-edit"><a href="javascript:;" onclick="cms.command(this);" title="Edit" data-enabled="edit"><span class="cms-icon"></span>Edit</a></li>	
						<li class="cms-ribbon-button-large cms-button-save" style="display: none;"><a href="javascript:;" onclick="cms.command(this);" title="Save & Close" data-enabled="edit"><span class="cms-icon"></span>Save &amp; Close</a></li>			
					</ul>
					<h3 class="cms-ribbon-group-label">Edit</h3>
				</div>			
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-paste"><a href="javascript:;" onclick="cms.command(this);" title="Paste"><span class="cms-icon"></span>Paste</a></li>	
						<li class="cms-ribbon-button-group">
							<ul class="cms-ribbon-button-group-column">
								<li class="cms-ribbon-button-text cms-button-cut"><a href="javascript:;" onclick="cms.command(this);" title="Cut"><span class="cms-icon"></span>Cut</a></li>	
								<li class="cms-ribbon-button-text cms-button-copy"><a href="javascript:;" onclick="cms.command(this);" title="Copy"><span class="cms-icon"></span>Copy</a></li>	
								<li class="cms-ribbon-button-text cms-button-undo"><a href="javascript:;" onclick="cms.command(this);" title="Undo"><span class="cms-icon"></span>Undo</a></li>	
							</ul>
						</li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Clipboard</h3>
				</div>				
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-group">
							<div class="cms-ribbon-button-group-elements-wrap">
								<ul class="cms-ribbon-button-group-elements cms-ribbon-white">
									<li class="cms-ribbon-button-small" id="cms-button-fonttype">
										<select id="cms-button-fonttype-select">
											<option value="">Font</option>																					
											<option class="cms-font-verdana" value="Verdana">Verdana</option>
											<option class="cms-font-arial" value="Arial">Arial</option>
											<option class="cms-font-geneva" value="Geneva">Geneva</option>
											<option class="cms-font-tahoma" value="Tahoma">Tahoma</option>
											<option class="cms-font-sans-serif" value="sans-serif">Sans-Serif</option>
										</select>
									</li>
								</ul>
								<ul class="cms-ribbon-button-group-elements cms-ribbon-white">
									<li class="cms-ribbon-button-small" id="cms-button-fontsize">
										<select id="cms-button-fontsize-select">
											<option value="">Size</option>																			
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
										</select>
									</li>									
									<div class="cms-clear"></div>							
								</ul>
								<div class="cms-clear"></div>
							</div>
							<div class="cms-ribbon-button-group-elements-wrap">
								<ul class="cms-ribbon-button-group-elements">
									<li class="cms-ribbon-button-small cms-button-bold"><a href="javascript:;" onclick="cms.command(this);" title="Bold"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-italics" ><a href="javascript:;" onclick="cms.command(this);" title="Italics"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-underline"><a href="javascript:;" onclick="cms.command(this);" title="Underline"><span class="cms-icon"></span></a></li>	
									<li class="cms-ribbon-button-small cms-button-strikethru"><a href="javascript:;" onclick="cms.command(this);" title="Strikethrough"><span class="cms-icon"></span></a></li>	
									<li class="cms-ribbon-button-small cms-button-subscript"><a href="javascript:;" onclick="cms.command(this);" title="Subscript"><span class="cms-icon"></span></a></li>	
									<li class="cms-ribbon-button-small cms-button-superscript"><a href="javascript:;" onclick="cms.command(this);" title="Superscript"><span class="cms-icon"></span></a></li>	
									<div class="cms-clear"></div>							
								</ul>
								<ul class="cms-ribbon-button-group-elements">
									<li class="cms-ribbon-button-small cms-ribbon-button-small-dropdown cms-button-highlight">
										<a id="cms-button-highlight-a" href="javascript:;" title="Text Highlight Color"><span class="cms-icon"></span><span class="cms-drop-icon"></span></a>
									</li>
									<li class="cms-ribbon-button-small cms-ribbon-button-small-dropdown cms-button-color">
										<a id="cms-button-color-a" href="javascript:;" title="Font Color"><span class="cms-icon"></span><span class="cms-drop-icon"></span></a>
									</li>
									<div class="cms-clear"></div>							
								</ul>								
								<ul class="cms-ribbon-button-group-elements">
									<li class="cms-ribbon-button-small cms-button-clear"><a href="javascript:;" onclick="cms.command(this);" title="Clear Formatting"><span class="cms-icon"></span></a></li>
									<div class="cms-clear"></div>							
								</ul>
								<div class="cms-clear"></div>
							</div>
						</li>
					</ul>
					<h3 class="cms-ribbon-group-label">Font</h3>
				</div>	
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">	
						<li class="cms-ribbon-button-group">
							<div class="cms-ribbon-button-group-elements-wrap">
								<ul class="cms-ribbon-button-group-elements">
									<li class="cms-ribbon-button-small cms-button-unordered-list"><a href="javascript:;" onclick="cms.command(this);" title="Bullet List"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-ordered-list"><a href="javascript:;" onclick="cms.command(this);" title="Number list"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-outdent"><a href="javascript:;" onclick="cms.command(this);" title="Decrease Indent"><span class="cms-icon"></span></a></li>	
									<li class="cms-ribbon-button-small cms-button-indent"><a href="javascript:;" onclick="cms.command(this);" title="Increase Indent"><span class="cms-icon"></span></a></li>			
									<li class="cms-ribbon-button-small cms-button-ltr"><a href="javascript:;" onclick="cms.command(this);" title="Left To Right"><span class="cms-icon"></span></a></li>			
									<li class="cms-ribbon-button-small cms-button-rtl"><a href="javascript:;" onclick="cms.command(this);" title="Right to Left"><span class="cms-icon"></span></a></li>			
									<div class="cms-clear"></div>							
								</ul>
								<div class="cms-clear"></div>
							</div>
							<div class="cms-ribbon-button-group-elements-wrap">
								<ul class="cms-ribbon-button-group-elements">
									<li class="cms-ribbon-button-small cms-button-align-left"><a href="javascript:;" onclick="cms.command(this);" title="Text Align Left"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-align-center"><a href="javascript:;" onclick="cms.command(this);" title="Text Align Center"><span class="cms-icon"></span></a></li>
									<li class="cms-ribbon-button-small cms-button-align-right"><a href="javascript:;" onclick="cms.command(this);" title="Text Align Right"><span class="cms-icon"></span></a></li>	
									<li class="cms-ribbon-button-small cms-button-align-justify"><a href="javascript:;" onclick="cms.command(this);" title="Justify"><span class="cms-icon"></span></a></li>			
									<div class="cms-clear"></div>							
								</ul>
								<div class="cms-clear"></div>
							</div>
						</li>							
					</ul>
					<h3 class="cms-ribbon-group-label">Paragraph</h3>
				</div>	
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements cms-ribbon-styles">
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Paragraph"><span class="cms-style-icon cms-style-p">AaBbCcDd</span>Paragraph</a></li>
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Preformatted"><span class="cms-style-icon cms-style-pre">AaBbCcDd</span>Preformat</a></li>					
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 1"><span class="cms-style-icon cms-style-h1">AaBbCcDd</span>Heading 1</a></li>
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 2"><span class="cms-style-icon cms-style-h2">AaBbCcDd</span>Heading 2</a></li>						
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 3"><span class="cms-style-icon cms-style-h3">AaBbCcDd</span>Heading 3</a></li>	
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 4"><span class="cms-style-icon cms-style-h4">AaBbCcDd</span>Heading 4</a></li>																	
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 5"><span class="cms-style-icon cms-style-h5">AaBbCcDd</span>Heading 5</a></li>	
						<li class="cms-ribbon-button-style-option"><a href="javascript:;" onclick="cms.command(this);" title="Heading 6"><span class="cms-style-icon cms-style-h6">AaBbCcDd</span>Heading 6</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Styles</h3>
				</div>	
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-spelling"><a href="javascript:;" onclick="cms.command(this);" title="Spelling"><span class="cms-icon"></span>Spelling</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">Spelling</h3>
				</div>					
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-markup"><a href="javascript:;" onclick="cms.command(this);" title="Edit HTML"><span class="cms-icon"></span>HTML</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">HTML</h3>
				</div>									
				<div class="cms-clear"></div>		
			</div>
			<div id="cms-ribbon-insert" class="cms-ribbon-bar">
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-ribbon-button-large-dropdown cms-button-table"><a href="javascript:;" title="Insert Table">
							<span class="cms-icon"></span>Table<span class="cms-drop-icon"></span>
						</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Tables</h3>
				</div>
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-link"><a href="javascript:;" onclick="cms.command(this);" title="Insert Link"><span class="cms-icon"></span>Link</a></li>	
						<li class="cms-ribbon-button-large cms-button-upload"><a href="javascript:;" onclick="cms.command(this);" title="Upload"><span class="cms-icon"></span>Upload File</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">Links</h3>
				</div>				
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-picture"><a href="javascript:;" onclick="cms.command(this);" title="Insert Picture"><span class="cms-icon"></span>Picture</a></li>	
						<li class="cms-ribbon-button-large cms-button-video"><a href="javascript:;" onclick="cms.command(this);" title="Insert Media"><span class="cms-icon"></span>Video &amp; Audio</a></li>
						<li class="cms-ribbon-button-large cms-button-attachment"><a href="javascript:;" onclick="cms.command(this);" title="Insert Attachment"><span class="cms-icon"></span>Attachment</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">Media</h3>
				</div>	
				<div class="cms-clear"></div>	
			</div>
			<div id="cms-ribbon-tools" class="cms-ribbon-bar">
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-markup"><a href="javascript:;" onclick="cms.command(this);" title="Edit HTML"><span class="cms-icon"></span>Markup</a></li>	
						<li class="cms-ribbon-button-large" id="cms-button-html-tidy"><a href="javascript:;" onclick="cms.command(this);" title="HTML Tidy"><span class="cms-icon"></span>HTML Tidy</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">HTML</h3>
				</div>
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-spelling"><a href="javascript:;" onclick="cms.command(this);" title="Spelling"><span class="cms-icon"></span>Spelling</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">Spelling</h3>
				</div>					
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-link-check"><a href="javascript:;" onclick="cms.command(this);" title="Link Checker"><span class="cms-icon"></span>Link Checker</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Links</h3>
				</div>	
				<div class="cms-clear"></div>	
			</div>	
			<div id="cms-ribbon-files" class="cms-ribbon-bar">		
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-upload"><a href="javascript:;" onclick="cms.command(this);" title="Upload" data-enabled="edit"><span class="cms-icon"></span>Upload File</a></li>
						<li class="cms-ribbon-button-large cms-button-viewallfiles"><a href="javascript:;" onclick="cms.command(this);" title="View All Files" data-enabled="edit"><span class="cms-icon"></span>View All<br>Files</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">File Library</h3>
				</div>		
				<div class="cms-clear"></div>	
			</div>				
			<div id="cms-ribbon-session" class="cms-ribbon-bar">		
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-logout"><a href="<?php echo $_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?logout"; ?>" title="Logout" data-enabled="edit"><span class="cms-icon"></span>Logout</a></li>
						<li class="cms-ribbon-button-large cms-button-password"><a href="javascript:;" onclick="cms.command(this);" title="Change Password" data-enabled="edit"><span class="cms-icon"></span>Change<br>Password</a></li>	
					</ul>
					<h3 class="cms-ribbon-group-label">Session</h3>
				</div>	
				<div class="cms-ribbon-group">
					<ul class="cms-ribbon-elements">
						<li class="cms-ribbon-button-large cms-button-newuser"><a href="javascript:;" onclick="cms.command(this);" title="New User" data-enabled="edit"><span class="cms-icon"></span>New User</a></li>	
						<li class="cms-ribbon-button-large cms-button-viewusers"><a href="javascript:;" onclick="cms.command(this);" title="View Users" data-enabled="edit"><span class="cms-icon"></span>View All<br>Users</a></li>
					</ul>
					<h3 class="cms-ribbon-group-label">Manage</h3>
				</div>					
				<div class="cms-clear"></div>	
			</div>								
		</div>
	</div>
	<form method="post" id="cms-content-form" style="display: none;" action="<?php echo $_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?save"; ?>"></form>
	<div id="cms-controls-end"></div>
	
	