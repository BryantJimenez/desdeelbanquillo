(function($) {

 	"use strict";

 	$('[data-toggle="tooltip"]').tooltip();

 	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

})(jQuery);

$(document).ready(function() {
	if ($("#lightgallery").length) {
		$("#lightgallery").lightGallery();
	} 
});

$('#facebook').hover(function() {
	$(this).attr('src', '/web/img/facebookrojo.png');
}, function() {
	$(this).attr('src', '/web/img/facebookblanco.png');
});

$('#twitter').hover(function() {
	$(this).attr('src', '/web/img/twitterrojo.png');
}, function() {
	$(this).attr('src', '/web/img/twitterblanco.png');
});

$('#instagram').hover(function() {
	$(this).attr('src', '/web/img/instarojo.png');
}, function() {
	$(this).attr('src', '/web/img/instablanco.png');
});

$('#modal-login .btn-register').click(function() {
	$('#modal-login').modal('hide');
	$('#modal-register').modal();
});

$('#modal-register .btn-login').click(function() {
	$('#modal-register').modal('hide');
	$('#modal-login').modal();
});