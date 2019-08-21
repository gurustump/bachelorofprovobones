/*
 * Admin Scripts File
 * Author: Matthew Stumphy
 *
 * Just any extra javascript to run in the admin area.
*/


jQuery(document).ready(function($) {
	toggleMetaboxes($);
	$('#_bachelor_person_role, #page_template').change(function() {
		toggleMetaboxes($);
	});
});

function toggleMetaboxes($) {
	var personRole = $('#_bachelor_person_role').val();
	if (personRole == 'crew') {
		$('.cmb-row.cast-member-field').hide();
		$('.cmb-row.crew-member-field').show();
		console.log('hiding');
	} else {
		$('.cmb-row.cast-member-field').show();
		$('.cmb-row.crew-member-field').hide();
	}
	
	if ($('#page_template').val() == 'page-home.php') {
		$('.cmb-row.page-home-admin').show()
	} else {
		$('.cmb-row.page-home-admin').hide()
	}
}