$(document).ready(function(){
	//Usuarios login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191,
					remote: {
						url: "/registro/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Recuperar
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Recuperar Contraseña
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Perfil
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Administradores
	$("button[action='admin']").on("click",function(){
		$("#formAdministrator").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='admin']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Categorias
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='category']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Create
	$("button[action='banner']").on("click",function(){
		$("#formBannerCreate").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				featured: {
					required: true
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Edit
	$("button[action='banner']").on("click",function(){
		$("#formBannerEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				featured: {
					required: true
				},

				state: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Noticias Create
	$("button[action='new']").on("click",function(){
		$("#formNewCreate").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				summary: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				content: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				video: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				tags: {
					required: true,
					minlength: 1,
					maxlength: 2000
				},

				comments: {
					required: true
				},

				category_id: {
					required: true
				},

				featured: {
					required: false
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				summary: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				content: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				video: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				comments: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='new']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Noticias Edit
	$("button[action='new']").on("click",function(){
		$("#formNewEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				summary: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				content: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				video: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				tags: {
					required: true,
					minlength: 1,
					maxlength: 2000
				},

				comments: {
					required: true
				},

				category_id: {
					required: true
				},

				featured: {
					required: false
				},

				state: {
					required: true
				},
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				summary: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				content: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				video: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				comments: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='new']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Comentarios
	$("button[action='comment']").on("click",function(){
		$("#formComment").validate({
			rules:
			{
				text: {
					required: true,
					minlength: 1,
					maxlength: 65000
				}
			},
			messages:
			{
				text: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='comment']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Videos
	$("button[action='video']").on("click",function(){
		$("#formVideo").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				video: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				featured: {
					required: true
				},

				state: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				video: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='video']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Galeria Create
	$("button[action='gallery']").on("click",function(){
		$("#formGalleryCreate").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				category_id: {
					required: true
				},

				featured: {
					required: true
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='gallery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Galeria Edit
	$("button[action='gallery']").on("click",function(){
		$("#formGalleryEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				category_id: {
					required: true
				},

				featured: {
					required: true
				},

				state: {
					required: true
				},
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='gallery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Torneos
	$("button[action='tournament']").on("click",function(){
		$("#formTournament").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				year: {
					required: true
				},

				days: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				year: {
					required: 'Seleccione una opción.'
				},

				days: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='tournament']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Equipos
	$("button[action='team']").on("click",function(){
		$("#formTeam").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='team']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Equipos
	$("button[action='team']").on("click",function(){
		$("#formTeam").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='team']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Jugadores
	$("button[action='player']").on("click",function(){
		$("#formPlayer").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				position_id: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				position_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='player']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Estadios
	$("button[action='stadium']").on("click",function(){
		$("#formStadium").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='stadium']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Ajustes
	$("button[action='setting']").on("click",function(){
		$("#formSetting").validate({
			rules:
			{
				facebook: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				instagram: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				twitter: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				listen: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				email_one: {
					required: false,
					email: true,
					minlength: 2,
					maxlength: 191
				},

				email_two: {
					required: false,
					email: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: false
				}
			},
			messages:
			{
				facebook: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				instagram: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				twitter: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				listen: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email_one: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email_two: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},
			},
			submitHandler: function(form) {
				$("button[action='setting']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Scores
	$("button[action='score']").on("click",function(){
		$("#formScore").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				time: {
					required: true,
					min: 1,
					max: 130
				},

				goals_one: {
					required: true,
					min: 0,
					max: 99
				},

				goals_two: {
					required: true,
					min: 0,
					max: 99
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				time: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				},

				goals_one: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				},

				goals_two: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='score']").attr('disabled', true);
				form.submit();
			}
		});
	});
});