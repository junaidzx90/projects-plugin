(function( $ ) {
	'use strict';

	$('#rest_color').on('click', function (e) {
		e.preventDefault();
		$.ajax({
			type: "post",
			url: admin_ajax_action.ajaxurl,
			data: {
				action: 'ppprojects_reset_colors'
			},
			success: function (response) {
				location.reload();
			}
		}); 
	});

})( jQuery );
