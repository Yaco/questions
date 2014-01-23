<?php
/**
 * Javascript file for this plugin. This is added to the global site JS.
 *
 * @package ElggQuestions
 */
?>
//<script>
elgg.provide("elgg.questions");

elgg.questions.init = function() {

	$("form.questions-validate-container").submit(function() {
		var result = true;
		
		// validate there is a select
		if ($("#questions-container-guid").length) {
			if ($("select[name='container_guid']").val() == "") {
				result = false;

				alert(elgg.echo("questions:edit:question:container:select"));
			}
		}

		return result;
	});
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.questions.init);