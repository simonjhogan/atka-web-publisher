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

	//CMS Object	
	function CMS() {
		this.focusedElement;
		this.colorSelectId;
		this.currentSelection;		
		this.currentRange;
		this.dialogAction;
		this.selectedPath;
		this.treeViewURL;
		this.spellingData;
		this.spellingDataCounter;
		this.demoMode;
	}
			
	CMS.prototype.command = function(link) {
		if ($(link).attr("disabled") != "disabled") {
			switch (link.title.toLowerCase()) {
				case "edit":
					this.editMode();
					break;	
				case "save & close":
					this.savePage();
					break;								
				case "cut":
					this.execCommand('cut');
					break;	
				case "copy":
					this.execCommand('copy');
					break;	
				case "paste":
					this.execCommand('paste');
					break;	
				case "undo":
					this.execCommand('undo');
					break;	
				case "bold":
					this.execCommand('bold');
					break;	
				case "italics":
					this.execCommand('italic');
					break;	
				case "underline":
					this.execCommand('underline');
					break;	
				case "strikethrough":
					this.execCommand('strikeThrough');
					break;	
				case "subscript":
					this.execCommand('subscript');
					break;	
				case "superscript":
					this.execCommand('superscript');
					break;	
				case "clear formatting":
					this.execCommand('removeFormat');
					break;			
				case "bullet list":
					this.execCommand('insertUnorderedList');
					break;	
				case "number list":
					this.execCommand('insertOrderedList');
					break;	
				case "decrease indent":
					this.execCommand('outdent');
					break;	
				case "increase indent":
					this.execCommand('indent');
					break;	
				case "left to right":
					this.execCommand('blockDirLTR');
					break;	
				case "right to left":
					this.execCommand('BlockDirRTL');
					break;					
				case "text align left":
					this.execCommand('justifyLeft');
					break;	
				case "text align center":
					this.execCommand('justifyCenter');
					break;	
				case "text align right":
					this.execCommand('justifyRight');
					break;	
				case "justify":
					this.execCommand('justifyFull');
					break;	
				case "heading 1":
					this.execCommand('formatBlock', false, "<h1>");
					break;	
				case "heading 2":
					this.execCommand('formatBlock', false, "<h2>");
					break;
				case "heading 3":
					this.execCommand('formatBlock', false, "<h3>");
					break;
				case "heading 4":
					this.execCommand('formatBlock', false, "<h4>");
					break;
				case "heading 5":
					this.execCommand('formatBlock', false, "<h5>");
					break;
				case "heading 6":
					this.execCommand('formatBlock', false, "<h6>");
					break;
				case "preformatted":
					this.execCommand('formatBlock', false, "<pre>");
					break;	
				case "paragraph":
					this.execCommand('formatBlock', false, "<p>");
					break;	
				case "insert link":
					this.dialogAction = "Insert Link";
					this.insertDialog();
					break;	
				case "insert picture":
					this.dialogAction = "Insert Picture";
					this.insertDialog();
					break;	
				case "insert media":
					this.dialogAction = "Insert Media";
					this.insertDialog();
					break;	
				case "insert attachment":
					this.dialogAction = "Insert Attachment";
					this.insertDialog();
					break;						
				case "upload":
					this.dialogAction = "Upload File";
					this.insertDialog();
					break;
				case "new page":
					this.dialogAction = "New Page";
					this.insertDialog();
					break;												
				case "edit html":
					this.htmlEditDialog();
					break;	
				case "view all pages":
					this.dialogAction = "All Pages";
					this.insertDialog();
					break;
				case "view all files":
					this.dialogAction = "All Files";
					this.insertDialog();
					break;
				case "page template":	
					this.setTemplateDialog();
					break;	
				case "make homepage":	
					this.setHomepage();
					break;	
				case "link checker":
					this.linkCheckerDialog();
					break;	
				case "spelling":
					this.spellCheckerDialog();
					break;
				case "html tidy":
					this.tidyHtmlDialog();
					break;	
				case "new user":
					this.newUserDialog();
					break;
				case "view users":
					this.viewUsersDialog();
					break;																																																																
				default:
					alert(link.title + " not implemented yet.");
					break;				
			}	
		}	
	};

	CMS.prototype.execCommand = function(command, ui, value) {
		if (!ui) {var ui = false;}
		if (!value) {var value = null;}
		
		this.focusedElement.focus();
		document.execCommand(command, ui, value);
		this.focusedElement.focus();
	};

	CMS.prototype.insertHTML = function(html) {
		if (!ui) {var ui = false;}
		if (!value) {var value = null;}
		
		if ($.browser.msie) {
			this.execCommand("insertHorizontalRule", false, "cms-placeholder-element");	
			$("hr#cms-placeholder-element").replaceWith(html);			
		} else {
			this.execCommand("insertHTML", false, html);
		}
	};

	CMS.prototype.setFontFamily = function(font) {
		this.execCommand('fontName', false, font);	
	};

	CMS.prototype.setFontSize = function(size) {
		this.execCommand('fontSize', false, size);			
	};

	CMS.prototype.getSelectedRange = function() {
		this.currentSelection = window.getSelection();	  
		return this.currentSelection.getRangeAt(0);
	};

	CMS.prototype.restoreRange = function() {
		try {
			this.currentSelection.removeAllRanges();
			this.currentSelection.addRange(this.currentRange);
		} catch(err) {}
	};	

	CMS.prototype.getSelectedText = function() {  
		try {
			return this.currentSelection.toString();
		} catch(err) {
			return "";
		}
	};
	
	CMS.prototype.setRibbonStyles = function(element) {
		$(".cms-style-" + element).css("font-family", $("#cms-style-compute " + element).css("font-family"));
		$(".cms-style-" + element).css("font-size", $("#cms-style-compute " + element).css("font-size"));
		if ($("#cms-style-compute " + element).css("color") != "rgb(255, 255, 255)") {
			$(".cms-style-" + element).css("color", $("#cms-style-compute " + element).css("color"));
		}	
	};

	CMS.prototype.savePage = function() {
		if (this.demoMode) {
			alert("Function not supported in demonstration mode.");
		} else {
			$("#cms-content-form").html("");
			$(".cms-editable").each(function() {
				$("#cms-content-form").append("<textarea name=\"" + $(this).attr("id").substr(1) + "\">" + $(this).html() + "</textarea>");
			});
			$("#cms-content-form").submit();
		} 
	};

	CMS.prototype.setHomepage = function() {
		if (this.demoMode) {
			alert("Function not supported in demonstration mode.");
		} else {
			$.get('/index.php/_cms/page/set/homepage?id=' + _cms_content_id, function(data) {
 				alert("The default site homepage has been set to the current page.");
 			});
		}
	};

	
	CMS.prototype.editMode = function() {
		$(".cms-editable").attr("contenteditable", "true");
		$(".cms-editable").addClass("cms-editable-border");
		
		$(".cms-editable").mouseup(function(event) {
			cms.currentRange = cms.getSelectedRange();
		});

		$(".cms-editable").keyup(function(event) {
			cms.currentRange = cms.getSelectedRange();
		});

		$(".cms-editable").focus(function(event) {
			cms.focusedElement = event.target;
			$(event.target).append("<div id=\"cms-style-compute\" style=\"display: none;\"><p><p><pre></pre><h1></h1><h2></h2><h3></h3><h4></h4><h5></h5><h6></h6></div>");
			cms.setRibbonStyles("p");				
			cms.setRibbonStyles("pre");	
			cms.setRibbonStyles("h1");	
			cms.setRibbonStyles("h2");	
			cms.setRibbonStyles("h3");	
			cms.setRibbonStyles("h4");	
			cms.setRibbonStyles("h5");
			cms.setRibbonStyles("h6");																	
			$("#cms-style-compute").remove();								
		});
				
		$(".cms-button-edit").hide();
		$(".cms-button-save, #cms-ribbon-format-tab, #cms-ribbon-insert-tab, #cms-ribbon-tools-tab").show();
		$('#cms-controls a[disabled]').removeClass("cms-control-disabled");
		$('#cms-controls a, #cms-controls select').removeAttr('disabled');
		$("#cms-ribbon").tabs("select", "cms-ribbon-format");
	};

	CMS.prototype.initFontSelect = function() {
		$("#cms-button-fonttype-select").change(function(event) {
			cms.setFontFamily(event.target.value);
			event.target.value = "";
		});
		
		$("#cms-button-fontsize-select").change(function(event) {
			cms.setFontSize(event.target.value);	
			event.target.value = "";		
		});
	};

	CMS.prototype.initColorDropDown = function() {
		$("#cms-button-highlight-a").click(function(event) {
			event.stopPropagation();		
			var position = $(".cms-button-highlight").position();
							
			if ($("#cms-clp-dropdownmenu").is(":visible")) {
				$("#cms-clp-dropdownmenu").hide();	
			}
							
			if (cms.colorSelectId !=  "cms-button-highlight") {
				cms.colorSelectId = "cms-button-highlight";
				$("#cms-clp-dropdownmenu").css("top", (position.top+$(".cms-button-color a").height()+6)+"px").css("left", position.left+"px").show();	
			} else {
				cms.colorSelectId = "";
			}
		});

		$("#cms-button-color-a").click(function(event) {
			event.stopPropagation();		
			var position = $(".cms-button-color").position();
											
			if ($("#cms-clp-dropdownmenu").is(":visible")) {
				$("#cms-clp-dropdownmenu").hide();	
			}
							
			if (cms.colorSelectId !=  "cms-button-color") {
				cms.colorSelectId = "cms-button-color";
				$("#cms-clp-dropdownmenu").css("top", (position.top+$(".cms-button-color a").height()+6)+"px").css("left", position.left+"px").show();
			} else {
				cms.colorSelectId = "";
			}
		});

		$("#cms-clp-dropdownmenu a").click(function(event) {
			var color = $(event.target).css("background-color");
			switch(cms.colorSelectId) {
				case "cms-button-color":
					cms.execCommand('foreColor', false, color);
					break;
				case "cms-button-highlight":
					cms.execCommand('backColor', false, color);
					break;					
			}
		});	
		
		$("body").click(function(event) {
			if ($("#cms-clp-dropdownmenu").is(":visible")) {
				$("#cms-clp-dropdownmenu").hide();	
				cms.colorSelectId = "";
			}				
		});
	};

	CMS.prototype.initTableDropDown = function() {
		$(".cms-button-table a").click(function(event) {
			event.stopPropagation();		
			var position = $(".cms-button-table").position();
											
			if ($("#cms-tbl-dropdownmenu").is(":visible")) {
				$("#cms-tbl-dropdownmenu td").removeClass("cms-tbl-active");			
				$("#cms-tbl-dropdownmenu").hide();	
			} else {
				$("#cms-tbl-dropdownmenu").css("top", (position.top+$(".cms-button-table a").height()+6)+"px").css("left", position.left+"px").show();
			}
		});
		
		$(".cms-tbl-select-cell").mouseover(function(event) {
			event.stopPropagation();
			var tr = $(event.target).parent().parent().index()+1;
			var td = $(event.target).parent().index()+1;
						 
			$("#cms-tbl-dropdownmenu tr").slice(0, tr).each(function() {
				$(this).children("td").slice(0, td).addClass("cms-tbl-active");
			});
		});

		$(".cms-tbl-select-cell").mouseout(function(event) {
			event.stopPropagation();
			$("#cms-tbl-dropdownmenu td").removeClass("cms-tbl-active");
		});

		$(".cms-tbl-select-cell").click(function(event) {
			var tr = $(event.target).parent().parent().index()+1;
			var td = $(event.target).parent().index()+1;
			
			var html = "<table cellpadding=\"1\" cellspacing=\"1\" border=\"1\">\n";	
			for(y=0; y<tr; y++) {
				html += "<tr>\n";	
				html += "<td>&nbsp;</td>".repeat(td);
				html += "\n</tr>\n";						
			}
			html += "</table>&nbsp;";	
			

			cms.restoreRange();
			cms.insertHTML(html);
		});
		
		$("body").click(function(event) {
			if ($("#cms-tbl-dropdownmenu").is(":visible")) {
				$("#cms-tbl-dropdownmenu").hide();	
				$("#cms-tbl-dropdownmenu td").removeClass("cms-tbl-active");
				$("#cms-placeholder-element").remove();					
			}				
		});		
	};

	//Onload function
	cms = new CMS();
	
	$(document).ready(function() {	
		if (typeof _cms_demo_mode !== 'undefined') {
			cms.demoMode = _cms_demo_mode;
		}
		
		//Login window	
		if (window.location.search.indexOf("login") != -1) {
			$("#cms-password").keypress(function(event) {
				if (event.which == 13) {
					$("#cms-login-form").submit();
				}
			});
				
			$("#cms-login-dialog").dialog({
				autoOpen: true,
				height: 230,
				width: 360,
				resizable: false,
				modal: true,
				show: (window.location.search.indexOf("error") != -1) ? {effect: 'shake', duration: 100} : "",
				buttons: {
					"Login": function() {
						$("#cms-login-form").submit();
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		
		if ($("#cms-ribbon").length > 0) {
			$("#cms-ribbon").tabs();
			
			cms.initFontSelect();
			cms.initColorDropDown(); 
			cms.initTableDropDown();			
	
			if (window.location.search.indexOf("editmode") == -1) {
				//Disable ribbon buttons
				$("#cms-ribbon-format-tab, #cms-ribbon-insert-tab, #cms-ribbon-tools-tab").hide();			
				$(".cms-ribbon-tabs li a").attr("data-enabled", "edit");
				$("#cms-controls a[data-enabled!='edit'], #cms-controls select[data-enabled!='edit']").attr("disabled", "true");
				$("#cms-controls a[disabled]").addClass("cms-control-disabled");
			} else {
				cms.editMode();
			}
			$("#cms-controls").show();
		}
	});
	
	//Generic functions
	
	String.prototype.repeat = function(num)
	{
		return new Array(num + 1).join(this);
	}
	