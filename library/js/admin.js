/*
 * Admin Scripts File
 * Author: Matthew Stumphy
 *
 * Just any extra javascript to run in the admin area.
*/


jQuery(document).ready(function($) {
	toggleMetaboxes($);
	$('#_bachelor_person_role').change(function() {
		toggleMetaboxes($);
	});
});

function toggleMetaboxes($) {
	console.log('toggle');
	var personRole = $('#_bachelor_person_role').val();
	console.log(personRole);
	if (personRole == 'crew') {
		$('.cmb-row.cast-member-field').hide();
		console.log('hiding');
	} else {
		$('.cmb-row.cast-member-field').show();
	}
}