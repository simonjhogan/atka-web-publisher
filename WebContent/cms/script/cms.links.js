	CMS.prototype.insertLink = function() {
		$("#cms-link-url").val("");
		$("#cms-insert-link-dialog").dialog({
			autoOpen: true,
			height: 320,
			width: 480,
			resizable: true,
			modal: true,
			buttons: {
				"Insert": function() {
					cms.restoreRange();
					if ($("#cms-link-url").val().length > 0) {
						cms.execCommand("createLink", false, $("#cms-link-url").val());
					}
					$(this).dialog("close");
				},
				"Cancel": function() {
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});
		
		$.getJSON('/index.php/_json/pages', function(data) {
			$("#cms-insert-link-page-list #cms-data-table").html("<tr class=\"cms_header_row\"><th>Title</th><th>Path</th><th width=\"20\">Template</th><th width=\"20\">Modified</th></tr>");
			$("#cms-insert-link-page-list .cms-ajax-loader").show();
			$.each(data, function(item) {
				$("#cms-data-table").append("<tr><td class=\"cms-bold\">" + this.title + "</td><td class=\"cms-data-ref\">" + this.ref + "</td><td>" + this.template + "</td><td class=\"cms-align-right\">" + this.modified + "</td></tr>");
			});	
			
			$("#cms-data-table tr").not(".cms_header_row").mouseover(function(event) {
				$(this).addClass("cms-data-highlight");
			});

			$("#cms-data-table tr").not(".cms_header_row").mouseout(function(event) {
				$(this).removeClass("cms-data-highlight");
			});
			
			$("#cms-data-table tr").not(".cms_header_row").click(function(event) {
				$("#cms-link-url").val("/index.php" + $(this).children("td.cms-data-ref").text());
			});
			$("#cms-insert-link-page-list .cms-ajax-loader").hide();
		});
	};
