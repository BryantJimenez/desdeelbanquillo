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
 	// Lightgallery
 	if ($("#lightgallery").length) {
 		$("#lightgallery").lightGallery();
 	}

	//socials js
	if ($('#social').length) {
		$("#social").jsSocials({
			url: $("#social").attr('url'),
			showLabel: false,
			showCount: false,
			shares: ["facebook", "twitter"]
		});
	}

	//touchspin
	if ($('.hour').length) {
		$(".hour").TouchSpin({
			min: 1,
			max: 130,
			buttondown_class: 'btn btn-info rounded',
			buttonup_class: 'btn btn-info rounded'
		});
	}

	if ($('.goals').length) {
		$(".goals").TouchSpin({
			min: 0,
			max: 99,
			buttondown_class: 'btn btn-info rounded',
			buttonup_class: 'btn btn-info rounded'
		});
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

 $('#modal-login .btn-register, #modal-recovery .btn-register').click(function() {
 	$('#modal-login, #modal-recovery').modal('hide');
 	$('#modal-register').modal();
 });

 $('#modal-register .btn-login').click(function() {
 	$('#modal-register').modal('hide');
 	$('#modal-login').modal();
 });

 $('#modal-login .btn-recovery').click(function() {
 	$('#modal-login').modal('hide');
 	$('#modal-recovery').modal();
 });

 $('#comment-button').click(function() {
 	var text=$('textarea[name="text"]').val(), news_id=$('input[name="news_id"]').val();
 	$('#commentsErrors').addClass('d-none');
 	$('#commentsErrors').text('');
 	$('button[action="comment"]').attr('disabled', true);
 	if (text!="") {
 		if (text.length>1) {
 			if (text.length<65000) {
 				$.ajax({
 					url: '/admin/comentarios',
 					type: 'POST',
 					dataType: 'json',
 					data: {text: text, news_id: news_id},
 					headers: {
 						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 					}
 				})
 				.done(function(obj) {
 					if (obj.status) {
 						$("#comments-card").append($('<div>', {
 							class: "border-top py-3"
 						}).append($('<div>', {
 							class: "d-flex justify-content-start"
 						}).append($('<img>', {
 							src: "/web/img/imagencomentarionoticia.png",
 							width: "50",
 							height: "50",
 							alt: "Icono de Comentario"
 						})).append($('<div>', {
 							class: "text-muted ml-3"
 						}).append($('<p>', {
 							class: "h6 font-weight-bold mb-0",
 							text: obj.name+" "+obj.lastname
 						})).append($('<p>', {
 							class: "mb-0"
 						})).append($('<p>', {
 							class: "mb-0"
 						}).append($('<small>', {
 							text: obj.date
 						}))))).append($('<p>', {
 							class: "h6 font-weight-bold text-dark",
 							text: obj.text
 						})));

 						$('textarea[name="text"]').val("");
 						$('button[action="comment"]').attr('disabled', false);
 						Lobibox.notify(obj.type, {
 							title: obj.title,
 							sound: true,
 							msg: obj.msg
 						});
 					} else {
 						$('button[action="comment"]').attr('disabled', false);
 						Lobibox.notify(obj.type, {
 							title: obj.title,
 							sound: true,
 							msg: obj.msg
 						});
 					}
 				});
 			} else {
 				$('button[action="comment"]').attr('disabled', false);
 				$('#commentsErrors').text('El campo comentario debe tener al máximo 65000 caracteres');
 				$('#commentsErrors').removeClass('d-none');
 			}
 		} else {
 			$('button[action="comment"]').attr('disabled', false);
 			$('#commentsErrors').text('El campo comentario debe tener al mínimo 2 caracteres');
 			$('#commentsErrors').removeClass('d-none');
 		}
 	} else {
 		$('button[action="comment"]').attr('disabled', false);
 		$('#commentsErrors').text('El campo comentario es obligatorio');
 		$('#commentsErrors').removeClass('d-none');
 	}
 });

 $('#selectDayCalendar').change(function() {
 	var day=$(this).val(), tournament=$('#selectDayCalendar option:selected').attr('tournament');
 	window.location.href = "/liga/"+tournament+"/calendario?day="+day;
 });

 $('#selectDayClassification').change(function() {
 	var day=$(this).val(), tournament=$('#selectDayClassification option:selected').attr('tournament');
 	window.location.href = "/liga/"+tournament+"/clasificacion?day="+day;
 });

 // Modal de goles
 $('.goals').click(function() {
 	var match=$(this).attr('match');
 	$.ajax({
 		url: '/goles',
 		type: 'POST',
 		dataType: 'json',
 		data: {match: match},
 		headers: {
 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 		}
 	})
 	.done(function(obj) {
 		if (obj.status) {

 			$('#team-one div, #team-two div').remove();
 			$('#team_one_name').text(obj.team_one_name);
 			$('#team_two_name').text(obj.team_two_name);

 			if (obj.team_one.length>0) {
 				for (var i=obj.team_one.length-1; i>=0; i--) {
 					$("#team-one").append($('<div>', {
 						class: "row"
 					}).append($('<div>', {
 						class: "col-12"
 					}).append($('<p>', {
 						class: "h6 text-dark",
 						text: "1 Gol de "+obj.team_one[i].name
 					}))));
 				}
 			} else {
 				$("#team-one").append($('<div>', {
 					class: "row"
 				}).append($('<div>', {
 					class: "col-12"
 				}).append($('<p>', {
 					class: "h6 text-danger",
 					text: "Este equipo no ha marcado goles"
 				}))));
 			}

 			if (obj.team_two.length>0) {
 				for (var i=obj.team_two.length-1; i>=0; i--) {
 					$("#team-two").append($('<div>', {
 						class: "row"
 					}).append($('<div>', {
 						class: "col-12"
 					}).append($('<p>', {
 						class: "h6 text-dark",
 						text: "1 Gol de "+obj.team_two[i].name
 					}))));
 				}
 			} else {
 				$("#team-two").append($('<div>', {
 					class: "row"
 				}).append($('<div>', {
 					class: "col-12"
 				}).append($('<p>', {
 					class: "h6 text-danger",
 					text: "Este equipo no ha marcado goles"
 				}))));
 			}

 			$('#modalGoals').modal();
 		} else {
 			Lobibox.notify(obj.type, {
 				title: obj.title,
 				sound: true,
 				msg: obj.msg
 			});
 		}
 	});

 });

 $('.scores').click(function() {
 	$('.hour').val(1);
 	$('.goals').val(0);
 	$('#team_one_score').html($(this).attr('team_one')+'<b class="text-danger">*</b>');
 	$('#team_two_score').html($(this).attr('team_two')+'<b class="text-danger">*</b>');
 	$('#match').val($(this).attr('match'));
 	$('#modalScore').modal();
 });