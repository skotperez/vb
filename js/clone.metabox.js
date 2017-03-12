jQuery(document).ready(function($) {
	var idPrefix = "vb-";
	var containerId = "testing";
	var elemToCloneName = "_vb_year[]";
	// add button to add other field
	$("#"+ containerId +" .rwmb-meta-box").append('<div class="hide-if-no-js"><input id="'+ idPrefix +'add-element-name" type="text" value="" /><span id="'+ idPrefix +'add-element-button" class="button">+</span></div>');
	// function to clone on click
	$("#"+ idPrefix +"add-element-button").click(function() {
		var cloneValue = $("#"+ idPrefix +"add-element-name").val();
		if ( cloneValue != '' ) {
			var elemToClone = "#"+ containerId +" [name='"+ elemToCloneName +"']:last";
			var har = $(elemToClone).clone();
			$("#"+ containerId +" .rwmb-input").append("<br /><label>");
			$(elemToClone).clone().appendTo("#"+ containerId +" .rwmb-input");
			$("#"+ containerId +" .rwmb-input").append(cloneValue +"</label>");
			$(elemToClone).attr("value",cloneValue);
			$("#"+ idPrefix +"add-element-name").attr("value","");
		}
	});
});
