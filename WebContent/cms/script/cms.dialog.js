	CMS.prototype.htmlEditDialog = function() {
		$("#cms-html-editor").val($(this.focusedElement).html());
		$("#cms-html-editor-dialog").dialog({
			autoOpen: true,
			height: 400,
			width: 640,
			resizable: true,
			modal: true,
			buttons: {
				"Update": function() {
					$(cms.focusedElement).html($("#cms-html-editor").val());
					cms.restoreRange();
					$(this).dialog("close");
				},
				"Cancel": function() {
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});
	};

	CMS.prototype.setTemplateDialog = function() {
		$("#cms-select-template-dialog").dialog({
			autoOpen: true,
			height: 120,
			width: 640,
			resizable: false,
			modal: true,
			buttons: {
				"Modify": function() {
					if (cms.demoMode) {
						alert("Function not supported in demonstration mode.");
					} else {
						window.location.href = window.location.pathname + "?id=" + _cms_content_id + "&template=" + $("#cms-select-template").val() + "&editmode";
					}
				},
				"Cancel": function() {
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});
	};

	CMS.prototype.insertDialog = function() {				
		$("#cms-insert-dialog .cms-form").hide();
		$("#cms-insert-dialog .cms-form input").val("");		
		$("#cms-list-data").html("");
		var buttons = {};	
		var url = "";
		var listHeight = 240;

		switch (this.dialogAction) {
			case "Insert Link":
				url = "/index.php/_json/pages/pathtree";	
				$("#cms-link-text").val(cms.getSelectedText());		
				$("#cms-insert-link-form").show();
				buttons[this.dialogAction] = function() {
					cms.restoreRange();
					cms.insertLink();				
				};
				
				break;
			case "Insert Attachment":
				url = "/index.php/_json/files/pathtree";	
				$("#cms-file-text").val(cms.getSelectedText());				
				$("#cms-insert-file-link-form").show();
				buttons[this.dialogAction] = function() {
					cms.restoreRange();
					cms.insertFile();				
				};
				
				break;				
			case "Insert Media":
				url = "/index.php/_json/files/pathtree?filetype=media";				
				$("#cms-insert-media-form").show();
				buttons[this.dialogAction] = function() {
					cms.restoreRange();			
					cms.insertMedia();			
				};
				
				break;
			case "Insert Picture":
				url = "/index.php/_json/files/pathtree?filetype=image";				
				$("#cms-insert-image-form").show();
				listHeight = 210;
				buttons[this.dialogAction] = function() {
					cms.restoreRange();
					cms.insertImage();
				};
				
				break;	
			case "New Page":
				url = "/index.php/_json/pages/pathtree";				
				$("#cms-new-page-form").show();
				listHeight = 130;
				buttons[this.dialogAction] = function() {
					if (cms.demoMode) {
						alert("Function not supported in demonstration mode.");
					} else {
						cms.createPage();	
					}		
				};
				
				break;	
			case "All Pages":
				url = "/index.php/_json/pages/pathtree";	
				listHeight = 300;
				buttons["Delete Selected Pages"] = function() {
					if (cms.demoMode) {
						alert("Function not supported in demonstration mode.");
					} else {
						cms.deletePages();
					}
				};				
				buttons["Close"] = function() {
					cms.restoreRange();
					$(this).dialog("close");
				};
							
				break;		
			case "All Files":
				url = "/index.php/_json/files/pathtree";
				listHeight = 300;
				buttons["Delete Selected Files"] = function() {
					if (cms.demoMode) {
						alert("Function not supported in demonstration mode.");
					} else {
						cms.deleteFiles();
					}					
				};				
				buttons["Close"] = function() {
					cms.restoreRange();
					$(this).dialog("close");
				};
							
				break;													
			case "Upload File":
				url = "/index.php/_json/files/pathtree";				
				$("#cms-upload-file-form").show();
				listHeight = 150;
				buttons[this.dialogAction] = function() {
					if (cms.demoMode) {
						alert("Function not supported in demonstration mode.");
					} else {
						cms.uploadFile();	
					}					
				};
				
				break;				
		}

		if (this.dialogAction != "All Pages" & this.dialogAction != "All Files") {
			buttons["Cancel"] = function() {
				cms.restoreRange();
				$(this).dialog("close");
			};
		}
			
		cms.treeViewURL = url;		
		cms.treeView(url);
			
		$(".cms-list").height(listHeight);	
		$("#cms-insert-dialog").dialog({
			autoOpen: true,
			height: 400,
			width: 640,
			resizable: true,
			modal: true,
			title: this.dialogAction,
			buttons: buttons
		});
	};

	CMS.prototype.treeView = function(url) {
		$(".cms-list-tree .cms-list-content").jstree({ 
			"core": {
				"animation": 0
			},
			"json_data": {
				"ajax": {
					"url": url
				}
			}, 
			"themes": {
				"theme": "default",
				"dots": false,
				"url": "/resources/styles/ui/jstree.ui.css"
			},
			"ui": {
				"select_limit": 1,
				"initially_select": ["root"]
			},
			"plugins": [ "themes", "json_data", "ui" ]
		}).bind("select_node.jstree", function (event, data) { 
			cms.loadDialogDataView(data.inst.get_path().join("/"));
		});	
	
	};

	CMS.prototype.loadDialogDataView = function(path) {	
		path = (path.indexOf("/") == -1) ? "" : path.substring(path.indexOf("/")); 
		cms.selectedPath = path;
		$("#cms-list-data").html("<img src=\"/resources/styles/ui/images/ajax-loader.gif\" alt=\"loading ...\">");

		switch (this.dialogAction) {
			case "Insert Link":
				$.getJSON('/index.php/_json/pages?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th class=\"cms-header-title\">Title</th><th class=\"cms-header-template\">Template</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\"><td class=\"cms-bold\">" + this.title + "</td><td>" + this.template + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");	
						
					$(".cms-data-select").click(function(event){
						$("#cms-link-url").val("/index.php" + $(this).data("ref"));
					});	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});									
				});
				
				break;
			case "Insert Attachment":
				$.getJSON('/index.php/_json/files?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th class=\"cms-header-title\">Title</th><th class=\"cms-header-filetype\">Filetype</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\" data-filetype=\"" + this.filetype + "\"><td class=\"cms-bold\">" + this.title + "</td><td>" + this.filetype + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");	
	
					$(".cms-data-select").click(function(event){
						$("#cms-file-url").val(_cms_assets_path + $(this).data("ref"));
					});	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});														
				});
				
				break;				
			case "Insert Media":				
				$.getJSON('/index.php/_json/files?path=' + path + "&filetype=media", function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th class=\"cms-header-title\">Title</th><th class=\"cms-header-filetype\">Filetype</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\" data-filetype=\"" + this.filetype + "\"><td class=\"cms-bold\">" + this.title + "</td><td>" + this.filetype + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");	
					
					$(".cms-data-select").click(function(event){
						$("#cms-media-url").val(_cms_assets_path + $(this).data("ref"));
						$("#cms-media-filetype").val($(this).data("filetype"));
					});	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});															
				});

				break;
			case "Insert Picture":
				$.getJSON('/index.php/_json/files?path=' + path + "&filetype=image", function(data) {
					$("#cms-list-data").html("");					
					$.each(data, function(item) {
						$("#cms-list-data").append("<div class=\"cms-data-select cms-thumbnail\" data-title=\"" + this.title + "\" data-ref=\"" + this.ref + "\"><img src=\"" + _cms_assets_path + this.ref + "\"><div class=\"cms-thumb-title\">" + this.title + "</div></div>");
					});	
					
					$(".cms-data-select").click(function(event){
						$("#cms-image-url").val(_cms_assets_path + $(this).data("ref"));
					});	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});									
				});

				break;	
			case "New Page":
				$("#cms-page-url").val(path+"/newpage");
				$.getJSON('/index.php/_json/pages?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th class=\"cms-header-title\">Title</th><th class=\"cms-header-template\">Template</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\"><td class=\"cms-bold\">" + this.title + "</td><td>" + this.template + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");		

					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});									
				});
				
				break;	
			case "All Pages":	
				$.getJSON('/index.php/_json/pages?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th width=\"10\"><input type=\"checkbox\" id=\"cms-list-select-allpages\" value=\"selectAll\"></th><th class=\"cms-header-title\">Title</th><th class=\"cms-header-path\">Path</th><th class=\"cms-header-template\">Template</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\" data-id=\"" + this.id + "\"><td><input type=\"checkbox\" class=\"cms-list-select\" value=\"" + this.id + "\"></td><td class=\"cms-bold\">" + this.title + "</td><td>" + this.ref + "</td><td>" + this.template + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");		

					$("#cms-list-select-allpages").click(function(event) {
						$("#cms-list-data input").prop("checked", $(this).prop("checked"));
					});
					
					$(".cms-data-select").click(function(event){
						if (event.target.nodeName != "INPUT"){ 
							window.location.href = "/index.php" + $(this).data("ref");
						}
					});	

					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});									
				});
			
				break;	
			case "All Files":	
				$.getJSON('/index.php/_json/files?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th width=\"10\"><input type=\"checkbox\" id=\"cms-list-select-allfiles\" value=\"selectAll\"></th><th class=\"cms-header-title\">Title</th><th class=\"cms-header-filetype\">Filetype</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\" data-filetype=\"" + this.filetype + "\"><td><input type=\"checkbox\" class=\"cms-list-select\" value=\"" + this.id + "\"></td><td class=\"cms-bold\">" + this.title + "</td><td>" + this.filetype + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");	

					$("#cms-list-select-allfiles").click(function(event) {
						$("#cms-list-data input").prop("checked", $(this).prop("checked"));
					});
	
					$(".cms-data-select").click(function(event){
						if (event.target.nodeName != "INPUT"){ 
							window.open(_cms_assets_path + $(this).data("ref"), "_new");
						}
					});	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});														
				});
			
				break;													
			case "Upload File":
				$("#cms-upload-path").val(path);
				$.getJSON('/index.php/_json/files?path=' + path, function(data) {
					$("#cms-list-data").html("<table><tr class=\"cms-header-row\"><th class=\"cms-header-title\">Title</th><th class=\"cms-header-filetype\">Filetype</th><th class=\"cms-header-modified cms-align-right\">Modified</th></tr>");					
					$.each(data, function(item) {
						$("#cms-list-data table").append("<tr class=\"cms-data-select\" data-ref=\"" + this.ref + "\"><td class=\"cms-bold\">" + this.title + "</td><td>" + this.filetype + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
					});	
					$("#cms-list-data table").append("</table>");	
					
					$(".cms-data-select").mouseover(function(event){
						$(this).addClass("cms-data-select-hover");
					});	
					
					$(".cms-data-select").mouseout(function(event){
						$(this).removeClass("cms-data-select-hover");
					});					
				});
				
				break;				
		}				
	};
	
	CMS.prototype.validateForm = function(id) {
		var valid = true;
		var message = "";
		
		$("#" + id + " input[required='required']").each(function(){
			if ($(this).val() == "") {
				message += " - " + $(this).attr("name") + "\n";
				$(this).focus();
				valid = false;
			}
		});
		
		if (!valid) {
			alert("Please complete the following mandatory fields:\n" + message);
		}

		return valid;
	};
	
	CMS.prototype.insertLink = function() {		
		if (cms.validateForm("cms-insert-link-form")) {
			var url = $("#cms-link-url").val();
			var text = $("#cms-link-text").val();
			
			if (text.length == 0) {
				cms.execCommand("createLink", false, url);
			} else {
				cms.insertHTML("<a href=\"" + url + "\">" + text + "</a>");	
			}
			
			$("#cms-insert-dialog").dialog("close");
		}
	};

	CMS.prototype.insertImage= function() {		
		if (cms.validateForm("cms-insert-image-form")) {
			var url = $("#cms-image-url").val();
			var alt = $("#cms-image-alt").val();
			var width = $("#cms-image-width").val();
			var height = $("#cms-image-height").val();
			
			cms.insertHTML("<img src=\"" + url + "\" width=\"" + width + "\" height=\"" + height + "\" alt=\"" + alt + "\">");
			$("#cms-insert-dialog").dialog("close");
		}
	};
	
	CMS.prototype.insertMedia = function() {	
		if (cms.validateForm("cms-insert-media-form")) {	
			var url = $("#cms-media-url").val();
			var filetype = $("#cms-media-filetype").val();
			
			if (filetype.indexOf("audio") == -1) {
				html = "<video width=\"320\" height=\"240\" controls=\"controls\"><source src=\"" + url + "\" type=\"" + filetype + "\" /></video>";
			} else {
				html = "<audio controls=\"controls\"><source src=\"" + url + "\" type=\"" + filetype + "\" /></audio>";
			}
			
			cms.insertHTML(html);
			$("#cms-insert-dialog").dialog("close");
		}
	};

	CMS.prototype.insertFile = function() {		
		if (cms.validateForm("cms-insert-file-link-form")) {
			var url = $("#cms-file-url").val();
			var text = $("#cms-file-text").val();

			if (text.length == 0) {
				cms.execCommand("createLink", false, url);
			} else {
				cms.insertHTML("<a href=\"" + url + "\">" + text + "</a>");	
			}
			
			$("#cms-insert-dialog").dialog("close");
		}
	};

	CMS.prototype.createPage = function() {	
		if (cms.validateForm("cms-new-page-form")) {
			$("#cms-new-page-form").submit();	
		}	
	};

	CMS.prototype.deletePages = function() {	
		if ($(".cms-list-select:checked").length == 0) {
			alert("No pages selected for deletion.");
			return;
		}
				
		if (confirm("Press OK to delete the selected pages?")) {
			var idList = new Array()
			$(".cms-list-select:checked").each(function() {
				idList.push($(this).val());
			});
			$.get('/index.php/_cms/pages/delete?id=' + idList.join(","), function(data) {
 				cms.treeView(cms.treeViewURL);
 			});
		}	
	};

	CMS.prototype.deleteUsers = function() {	
		if ($(".cms-list-select:checked").length == 0) {
			alert("No users selected for deletion.");
			return;
		}

		if ($(".cms-list-select:checked").length == $("#cms-user-count").val()) {
			alert("You can not delete all users.");
			return;		
		}

		if (confirm("Press OK to delete the selected users?")) {
			var idList = new Array()
			$(".cms-list-select:checked").each(function() {
				idList.push($(this).val());
			});
			$.get('/index.php/_cms/users/delete?id=' + idList.join(","), function(data) {
 				cms.getUsersView();
 			});
		}	
	};

	CMS.prototype.deleteFiles = function() {
		if ($(".cms-list-select:checked").length == 0) {
			alert("No files selected for deletion.");
			return;
		}
		
		if (confirm("Press OK to delete the selected files?")) {
			var idList = new Array()
			$(".cms-list-select:checked").each(function() {
				idList.push($(this).val());
			});
			$.get('/index.php/_cms/files/delete?id=' + idList.join(","), function(data) {
  				cms.treeView(cms.treeViewURL);
			});
		}	
	};

	CMS.prototype.uploadFile = function() {	
		$("#cms-insert-dialog:parent").addClass("cms-control-disabled");
		$(".ui-dialog-buttonset button").attr("disabled", "disabled");
				
		$("#cms-upload-iframe").load(function(event) { 
			if (cms.selectedPath.indexOf("/") > -1) {
				cms.loadDialogDataView(cms.selectedPath);
			} else {
				cms.treeView(cms.treeViewURL);
			}
			$("#cms-insert-dialog:parent").removeClass("cms-control-disabled");
			$(".ui-dialog-buttonset button").removeAttr("disabled");					
			$("#cms-upload-file-form input").val("");				
		});

		if (cms.validateForm("cms-upload-file-form")) {
			$("#cms-upload-file-form").submit();	
		} else {
			$("#cms-insert-dialog:parent").removeClass("cms-control-disabled");
			$(".ui-dialog-buttonset button").removeAttr("disabled");
		}
	};	
	
	CMS.prototype.linkCheckerDialog = function() {
		$("#cms-link-checker-dialog").dialog({
			autoOpen: true,
			height: 400,
			width: 640,
			resizable: true,
			modal: true,
			buttons: {
				"Check Links": function() {
					cms.checkLinks();
				},
				"Cancel": function() {
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});
	};
	
	CMS.prototype.checkLinks = function() {	
		$("#cms-link-view table").html("");
		$("#cms-link-view table").append("<tr class=\"cms-header-row\"><th>Status</th><th>Link</th></tr>");
		$("a").each(function(index){
			if ($(this).attr("href").length > 0 & $(this).attr("href").substr(0, 1) != "#" & $(this).attr("href").substr(0, 10) != "javascript") {
				var url = (($(this).attr("href").indexOf("http") == -1) ? location.protocol + "//" + location.host: "") + $(this).attr("href");
				$.getJSON("/index.php/_cms/linkcheck?url=" + url + "&" + (new Date()) , function(data){
					$("#cms-link-view table").append("<tr><td>" + data.status + "</td><td>" + data.url + "</td></tr>");
				});
			}
		});
	};	

	CMS.prototype.spellCheckerDialog = function() {
		$("#cms-spelling-word").val("");
		
		var text = "";
		$(".cms-editable").each(function() {
			text += $(this).html();
		});
		
		$.post("/index.php/_cms/spelling/check", {words: text}, function(data){
			if (data.length == 0) {
				alert("No spelling corrections found.");
			} else {
				cms.spellingDataCounter = 0;
				cms.spellingData = data;
				cms.setSpellingCheckerOptions();
				cms.openSpellCheckerDialog();
			}
		});
	};
	
	CMS.prototype.setSpellingCheckerOptions = function() {
		$("#cms-spelling-word").val(cms.spellingData[cms.spellingDataCounter].word)
		$("#cms-spelling-word-hidden").val(cms.spellingData[cms.spellingDataCounter].word)
		$("#cms-spelling-suggest").html("");
				
		$.each(cms.spellingData[cms.spellingDataCounter].suggestions, function(item, value){
			if (item < 1) {
				$("#cms-spelling-suggest").append("<option value=\"" + value + "\" selected=\"selected\">" + value + "</option>");
			} else {
				$("#cms-spelling-suggest").append("<option value=\"" + value + "\">" + value + "</option>");
			}
		});	
	};
	
	CMS.prototype.openSpellCheckerDialog = function() {
		$("#cms-spell-checker-dialog").dialog({
			autoOpen: true,
			height: 250,
			width: 400,
			resizable: false,
			buttons: {
				"Change": function() {
					$(".cms-editable").each(function() {
						if ($("#cms-spelling-suggest").val()) {
							$(this).html($(this).html().replace($("#cms-spelling-word-hidden").val(), $("#cms-spelling-suggest").val()));
						} else {
							$(this).html($(this).html().replace($("#cms-spelling-word-hidden").val(), $("#cms-spelling-word").val()));
						}
					});

					if (cms.spellingDataCounter < cms.spellingData.length -1) {
						cms.spellingDataCounter++;
						cms.setSpellingCheckerOptions();	
					} else {
						cms.restoreRange();
						$(this).dialog("close");
						alert("Spelling check completed.");					
					}					
				},
				"Ignore": function() {
					if (cms.spellingDataCounter < cms.spellingData.length -1) {
						cms.spellingDataCounter++;
						cms.setSpellingCheckerOptions();	
					} else {
						cms.restoreRange();
						$(this).dialog("close");
						alert("Spelling check completed.");					
					}
				},				
				"Cancel": function() {
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});	
	};
	
	CMS.prototype.tidyHtmlDialog = function() {
		$("#cms-html-tidy-dialog").dialog({
			autoOpen: true,
			height: 250,
			width: 300,
			resizable: false,
			modal: true,
			buttons: {
				"Tidy": function() {
					cms.tidyHtml();	
				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}
		});
	};

	CMS.prototype.tidyHtml = function() {
		var html = new Array();
		var options = new Array();
		
		$(".cms-editable").each(function() {
			html.push($(this).html());
		});

		$("#cms-html-tidy-form input:checked").each(function() {
			options.push($(this).val());
		});
		

		$.post("/index.php/_cms/html/tidy", {"html[]": html, "options[]": options}, function(data){
			$(".cms-editable").each(function(index) {
				$(this).html(data[index]);
			});
			alert("HTML Tidy operation completed.");
			$("#cms-html-tidy-dialog").dialog("close");
		});
	};

	CMS.prototype.getUsersView = function() {
		$("#cms-users-view").html("<img src=\"/resources/styles/ui/images/ajax-loader.gif\" alt=\"loading ...\">");
		$.getJSON('/index.php/_json/users', function(data) {
			$("#cms-user-count").val(data.length);
			
			$("#cms-users-view").html("<table><tr class=\"cms-header-row\"><th width=\"10\"><input type=\"checkbox\" id=\"cms-list-select-allusers\" value=\"selectAll\"></th><th class=\"cms-header-user\">Username</th><th class=\"cms-header-fullname\">Fullname</th><th class=\"cms-header-email\">Email</th><th class=\"cms-header-role\">Role</th></tr>");					
			$.each(data, function(item) {
				$("#cms-users-view table").append("<tr class=\"cms-data-select\"><td><input type=\"checkbox\" class=\"cms-list-select\" value=\"" + this.id + "\"></td><td class=\"cms-bold\">" + this.username + "</td><td>" + this.fullname + "</td><td>" + this.email + "</td><td>" + this.role + "</td></tr>");
			});	
			$("#cms-users-view table").append("</table>");	

			$("#cms-list-select-allusers").click(function(event) {
				$("#cms-users-view input").prop("checked", $(this).prop("checked"));
			});
			
			$(".cms-data-select").mouseover(function(event){
				$(this).addClass("cms-data-select-hover");
			});	
			
			$(".cms-data-select").mouseout(function(event){
				$(this).removeClass("cms-data-select-hover");
			});														
		});
	};
	
	CMS.prototype.viewUsersDialog = function() {
		if (this.demoMode) {
			alert("Function not supported in demonstration mode.");
			return false;
		}
	
		$("#cms-view-users-dialog").dialog({
			autoOpen: true,
			height: 400,
			width: 640,
			resizable: true,
			modal: true,
			buttons: {
				"New User": function() {
					cms.newUserDialog();		
				},			
				"Delete": function() {
					cms.deleteUsers();		
				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}
		});
		
		this.getUsersView(); 
	};

	CMS.prototype.createUser = function() {			
		if (cms.validateForm("cms-new-user-form")) {
			$.post("/index.php/_cms/user/new", $("#cms-new-user-form").serialize(), function(data){
				$("#cms-new-user-form")[0].reset();
				$("#cms-new-user-dialog").dialog("close");
				if ($("#cms-view-users-dialog").dialog("isOpen")) {
					cms.getUsersView(); 
				}
			});			
		}	
	};
	
	CMS.prototype.newUserDialog = function() {
		if (this.demoMode) {
			alert("Function not supported in demonstration mode.");
			return false;
		}
		
		$("#cms-user-exists").html();
		$("#cms-user").keyup(function() {
			$.getJSON('/index.php/_json/user/exists?user=' + $("#cms-user").val(), function(data) {
				if (data) {
					$("#cms-user-exists").html("<img id='cms-user-exists' class='cms-valid-icon' src='/cms/styles/ui/images/cross.png' alt='This name already exists.'>");
				} else {
					$("#cms-user-exists").html("<img id='cms-user-valid' class='cms-valid-icon' src='/cms/styles/ui/images/tick.png' alt='This name is unique.'>");
				}
			});
		});

		$("#cms-password-confirm").keyup(function() {
			if ($("#cms-password-confirm").val() != $("#cms-password").val()) {
				$("#cms-pass-valid").html("<img id='cms-password-invalid' class='cms-valid-icon' src='/cms/styles/ui/images/cross.png' alt='Passwords don't match'>");
			} else {
				$("#cms-pass-valid").html("<img id='cms-password-valid' class='cms-valid-icon' src='/cms/styles/ui/images/tick.png' alt='Passwords match.'>");
			}
		});

		$("#cms-new-user-dialog").dialog({
			autoOpen: true,
			height: 330,
			width: 640,
			resizable: false,
			modal: true,
			buttons: {			
				"Create User": function() {
					cms.createUser();	
				},
				"Cancel": function() {
					$(this).dialog("close");
				}
			}
		});
	};
	