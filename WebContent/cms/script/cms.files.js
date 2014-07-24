	CMS.prototype.uploadFile = function() {
		$("#cms-upload-form input").val("");			
				
		$("#cms-upload-dialog").dialog({
			autoOpen: true,
			height: 270,
			width: 480,
			resizable: false,
			modal: true,
			buttons: {
				"Upload": function() {
					if (window.location.search.indexOf("demo") == -1) {
						if ($("#cms-upload-file").val().length > 0) {
							$("#cms-upload-dialog .cms-form-status-text").html("Uploading file, please wait.");
							$("#cms-upload-dialog .cms-form-status, #cms-upload-dialog .cms-form-status .cms-ajax-loader").show();
							$("#cms-upload-form").submit();	
						} else {
							$("#cms-upload-dialog .cms-form-status").show();
							$("#cms-upload-dialog .cms-form-status-text").html("No file selected for upload");
							$("#cms-upload-file").focus();
						}
					} else {
							$("#cms-upload-dialog .cms-form-status").show();
							$("#cms-upload-dialog .cms-form-status-text").html("Uploads not allowed in demonstration mode!");					
					}				
				},
				"Close": function() {
					$("#cms-upload-dialog .cms-form-status").hide();
					cms.restoreRange();
					$(this).dialog("close");
				}
			}
		});
	};

	$(document).ready(function() {			
		if ($("#cms-ribbon").length > 0) {
			//Upload iframe onload event handler
			$("#cms-upload-iframe").load(function(event) {
				$("#cms-upload-dialog .cms-form-status .cms-ajax-loader").hide();
				$("#cms-upload-dialog .cms-form-status .cms-form-status-text").html($("#cms-upload-iframe").contents().find("#cms-upload-status-message").html())
				$("#cms-upload-form input").val("");				
			});
			
			//Upload path autocomplete
			$("#cms-upload-path").autocomplete({
				source: "/index.php/_json/files/paths",
				minLength: 1,
				focus: function(event, ui){
					$("#cms-upload-path").val(ui.item.path);  							
					return false;
			    },				
				select: function(event, ui){
					$("#cms-upload-path").val(ui.item.path);  							
					return false;
			    }
			})
			.data("autocomplete")._renderItem = function( ul, item ) {
				return $("<li></li>")
				.data( "item.autocomplete", item )
				.append( "<a>" + item.path + "</a>" )
				.appendTo(ul);
			};	
			
			//Upload category autocomplete
			$("#cms-upload-category").autocomplete({
				source: "/index.php/_json/files/categories",
				minLength: 2,
				focus: function(event, ui){
					$("#cms-upload-category").val(ui.item.category);  							
					return false;
			    },				
				select: function(event, ui){
					$("#cms-upload-category").val(ui.item.category);  							
					return false;
			    }
			})
			.data("autocomplete")._renderItem = function( ul, item ) {
				return $("<li></li>")
				.data( "item.autocomplete", item )
				.append( "<a>" + item.category + "</a>" )
				.appendTo(ul);
			};		
		}
	});
