/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
$(document).ready(function() {
  //Validación para introducir solo números
  $('.number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  //Validación para introducir solo letras y espacios
  $('#name, #lastname').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  //Validación para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  if ($('.time-flatpickr').length) {
    flatpickr(document.getElementsByClassName('time-flatpickr'), {
      locale: 'es',
      enableTime: true,
      dateFormat: "d-m-Y H:i",
      minDate : "today"
    });
  }

  //Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "print": "Imprimir"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  //dropify para input file más personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: 'Arrastre y suelte una imagen o da click para seleccionarla',
        replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
        remove: 'Remover',
        error: 'Lo sentimos, el archivo es demasiado grande'
      },
      error: {
        'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
        'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
        'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
        'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
        'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
        'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
      }
    });
  }

  //CKeditor plugin
  if ($('#content-news').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-news');
  }

  //tags inputs plugin
  if ($('#tags').length) {
    $('#tags').tagsInput({
      'height': '80px',
      'width': '100%',
      'defaultText': 'Etiquetas'
    });
  }

  //touchspin
  if ($('.goals').length) {
    $(".goals").TouchSpin({
      min: 0,
      max: 99,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }
});

// Alternar entre estadisticas semanales y mensuales
$('#week_tab').click(function(event) {
  $('div[tab="month_tab"]').addClass('d-none');
  $('div[tab="week_tab"]').removeClass('d-none');
});

$('#month_tab').click(function(event) {
  $('div[tab="week_tab"]').addClass('d-none');
  $('div[tab="month_tab"]').removeClass('d-none');
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

// funcion para cambiar el input hidden al cambiar el switch de comentarios
$('#commentCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#commentHidden').val(1);
  } else {
    $('#commentHidden').val(0);
  }
});

// funcion para cambiar el input hidden al cambiar el switch de destacado
$('#featuredCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#featuredHidden').val(1);
  } else {
    $('#featuredHidden').val(0);
  }
});

//funciones para desactivar y activar usuarios
function deactiveAdmin(slug) {
  $("#deactiveAdmin").modal();
  $('#formDeactiveAdmin').attr('action', '/admin/administradores/' + slug + '/desactivar');
}

function activeAdmin(slug) {
  $("#activeAdmin").modal();
  $('#formActiveAdmin').attr('action', '/admin/administradores/' + slug + '/activar');
}

function deactiveUser(slug) {
  $("#deactiveUser").modal();
  $('#formDeactiveUser').attr('action', '/admin/usuarios/' + slug + '/desactivar');
}

function activeUser(slug) {
  $("#activeUser").modal();
  $('#formActiveUser').attr('action', '/admin/usuarios/' + slug + '/activar');
}

function deactiveBanner(slug) {
  $("#deactiveBanner").modal();
  $('#formDeactiveBanner').attr('action', '/admin/banners/' + slug + '/desactivar');
}

function activeBannerNew(slug) {
  $("#activeBannerNew").modal();
  $('#formActiveBannerNew').attr('action', '/admin/banners/noticias/' + slug + '/activar');
}

function deactiveBannerNew(slug) {
  $("#deactiveBannerNew").modal();
  $('#formDeactiveBannerNew').attr('action', '/admin/banners/noticias/' + slug + '/desactivar');
}

function activeBanner(slug) {
  $("#activeBanner").modal();
  $('#formActiveBanner').attr('action', '/admin/banners/' + slug + '/activar');
}

function deactiveNew(slug) {
  $("#deactiveNew").modal();
  $('#formDeactiveNew').attr('action', '/admin/noticias/' + slug + '/desactivar');
}

function activeNew(slug) {
  $("#activeNew").modal();
  $('#formActiveNew').attr('action', '/admin/noticias/' + slug + '/activar');
}

function deactiveComment(slug) {
  $("#deactiveComment").modal();
  $('#formDeactiveComment').attr('action', '/admin/comentarios/' + slug + '/desactivar');
}

function activeComment(slug) {
  $("#activeComment").modal();
  $('#formActiveComment').attr('action', '/admin/comentarios/' + slug + '/activar');
}

function deactiveCommentUser(slug) {
  $("#deactiveCommentUser").modal();
  $('#formDeactiveCommentUser').attr('action', '/admin/comentarios/usuarios/' + slug + '/desactivar');
}

function activeCommentUser(slug) {
  $("#activeCommentUser").modal();
  $('#formActiveCommentUser').attr('action', '/admin/comentarios/usuarios/' + slug + '/activar');
}

function deactiveVideo(slug) {
  $("#deactiveVideo").modal();
  $('#formDeactiveVideo').attr('action', '/admin/videos/' + slug + '/desactivar');
}

function activeVideo(slug) {
  $("#activeVideo").modal();
  $('#formActiveVideo').attr('action', '/admin/videos/' + slug + '/activar');
}

function deactiveCategoryGallery(slug) {
  $("#deactiveCategoryGallery").modal();
  $('#formDeactiveCategoryGallery').attr('action', '/admin/galeria/categorias/' + slug + '/desactivar');
}

function activeCategoryGallery(slug) {
  $("#activeCategoryGallery").modal();
  $('#formActiveCategoryGallery').attr('action', '/admin/galeria/categorias/' + slug + '/activar');
}

function deactiveGallery(slug) {
  $("#deactiveGallery").modal();
  $('#formDeactiveGallery').attr('action', '/admin/galeria/' + slug + '/desactivar');
}

function activeGallery(slug) {
  $("#activeGallery").modal();
  $('#formActiveGallery').attr('action', '/admin/galeria/' + slug + '/activar');
}

//funciones para preguntar al eliminar
function deleteUser(slug) {
  $("#deleteUser").modal();
  $('#formDeleteUser').attr('action', '/admin/usuarios/' + slug);
}

function deleteBanner(slug) {
  $("#deleteBanner").modal();
  $('#formDeleteBanner').attr('action', '/admin/banners/' + slug);
}

function deleteBannerNew(slug) {
  $("#deleteBannerNew").modal();
  $('#formDeleteBannerNew').attr('action', '/admin/banners/noticias/' + slug);
}

function deleteCategory(slug) {
  $("#deleteCategory").modal();
  $('#formDeleteCategory').attr('action', '/admin/categorias/' + slug);
}

function deleteNew(slug) {
  $("#deleteNew").modal();
  $('#formDeleteNew').attr('action', '/admin/noticias/' + slug);
}

function deleteComment(slug) {
  $("#deleteComment").modal();
  $('#formDeleteComment').attr('action', '/admin/comentarios/' + slug);
}

function deleteVideo(slug) {
  $("#deleteVideo").modal();
  $('#formDeleteVideo').attr('action', '/admin/videos/' + slug);
}

function deleteCategoryGallery(slug) {
  $("#deleteCategoryGallery").modal();
  $('#formDeleteCategoryGallery').attr('action', '/admin/galeria/categorias/' + slug);
}

function deleteGallery(slug) {
  $("#deleteGallery").modal();
  $('#formDeleteGallery').attr('action', '/admin/galeria/' + slug);
}

function deleteTournament(slug) {
  $("#deleteTournament").modal();
  $('#formDeleteTournament').attr('action', '/admin/ligas/' + slug);
}

function deleteTeam(tournament, slug) {
  $("#deleteTeam").modal();
  $('#formDeleteTeam').attr('action', '/admin/ligas/' + tournament + '/equipos/' + slug);
}

function deletePlayer(tournament, team, slug) {
  $("#deletePlayer").modal();
  $('#formDeletePlayer').attr('action', '/admin/ligas/' + tournament + '/equipos/' + team + '/jugadores/' + slug);
}

function deleteStadium(slug) {
  $("#deleteStadium").modal();
  $('#formDeleteStadium').attr('action', '/admin/estadios/' + slug);
}

function deleteMatch(slug) {
  $("#deleteMatch").modal();
  $('#formDeleteMatch').attr('action', '/admin/partidos/' + slug);
}

// funcion para cambiar el texto de ayuda en banner al cambiar el tipo
$('#banner-type').change(function(event) {
  if ($(this).val()==1) {
    $('#text-image-size').text('La imagen debe tener un tamaño de 1410px de ancho y 500px de alto');
  } else if ($(this).val()==2 || $(this).val()==5) {
    $('#text-image-size').text('La imagen debe tener un tamaño de 1410px de ancho y 93px de alto');
  } else if ($(this).val()==3 || $(this).val()==6 || $(this).val()==7) {
    $('#text-image-size').text('La imagen debe tener un tamaño de 330px de ancho y 360px de alto');
  } else if ($(this).val()==4) {
    $('#text-image-size').text('La imagen debe tener un tamaño de 690px de ancho y 210px de alto');
  } else {
    $('#text-image-size').text('La imagen debe tener un tamaño de XXXX de ancho y XXXX de alto');
  }
});

// Agregar partido a la jornada
$('.add_match').click(function() {
  var day=$(this).attr('day');
  var date=$('.time-flatpickr[day="'+day+'"]').val(), first_team=$('.first_team_id[day="'+day+'"]').val(), second_team=$('.second_team_id[day="'+day+'"]').val(), stadium=$('.stadium_id[day="'+day+'"]').val();
  
  if (date!="" && first_team!="" && second_team!="" && stadium!="") {
    $(".add_match[day='"+day+"']").attr('disabled', true);
    $.ajax({
      url: '/admin/partidos',
      type: 'POST',
      dataType: 'json',
      data: {day: day, date: date, first_team: first_team, second_team: second_team, stadium: stadium},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {

      if (obj.status) {
        $(".days[day='"+day+"']").append($('<div>', {
          class: "row match",
          match: obj.match
        }).append($('<div>', {
          class: "col-lg-3 col-md-3 col-sm-6 col-12"
        }).append($('<p>', {
          class: "h6 text-black",
          text: obj.date
        }))).append($('<div>', {
          class: "col-lg-5 col-md-5 col-sm-6 col-12"
        }).append($('<p>', {
          class: "h6 text-black text-lg-center",
          html: obj.first_team+" <b class='text-danger'>VS</b> "+obj.second_team
        }))).append($('<div>', {
          class: "col-lg-3 col-md-3 col-sm-5 col-11"
        }).append($('<p>', {
          class: "h6 text-black",
          text: obj.stadium
        }))).append($('<div>', {
          class: "col-1"
        }).append($('<p>', {
          class: "h6 text-danger text-lg-center text-right",
          match: obj.match,
          onclick: "deleteMatch('"+obj.match+"');"
        }).append($('<i>', {
          class: "fa fa-trash"
        })))));

        $('.time-flatpickr[day="'+day+'"]').val("");
        $('.first_team_id[day="'+day+'"]').val("");
        $('.second_team_id[day="'+day+'"]').val("");
        $('.stadium_id[day="'+day+'"]').val("");

        Lobibox.notify(obj.type, {
          title: obj.title,
          sound: true,
          msg: obj.msg
        });
      } else {
        Lobibox.notify(obj.type, {
          title: obj.title,
          sound: true,
          msg: obj.msg
        });
      }
      
      $(".add_match[day='"+day+"']").attr('disabled', false);
    });
  } else {
    Lobibox.notify('error', {
      title: 'Campos incompletos',
      sound: true,
      msg: 'Hay campos que se encuentran vacios, ingrese todos los datos.'
    });
  }
});

// scroll de jornadas con select
$('#select-day').change(function(event) {
  var day=$(this).val();
  var coordinates=$("div[day='"+day+"']").position();
  window.scroll({
    top: coordinates.top,
    left: coordinates.left,
    behavior: 'smooth'
  });
});

// Cambiar estado de una jornada
$('.stateDayCheckbox').change(function() {
  var day=$(this).attr('day');
  if ($(this).is(':checked')) {
    var state="1";
  } else {
    var state="0";
  }
  $.ajax({
    url: '/admin/resultados/estado',
    type: 'POST',
    dataType: 'json',
    data: {day: day, state: state},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {
      $('.stateDayCheckbox').each(function() {
        if ($(this).attr('day')!=day) {
          $(this).attr('checked', false);
        } else {
          $(this).attr('checked', true);
        }
      });
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    } else {
      $('.stateDayCheckbox').each(function() {
        $(this).attr('checked', false);
      });
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    }
  });
});

// Cambiar estado de un partido
$('.stateMatchCheckbox').change(function() {
  var match=$(this).attr('match');
  if ($(this).is(':checked')) {
    var state="1";
  } else {
    var state="0";
  }
  $.ajax({
    url: '/admin/partidos/estado',
    type: 'POST',
    dataType: 'json',
    data: {match: match, state: state},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    } else {
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    }
  });
});

// Cambiar goles de un partido
$('.goals').change(function() {
  var match=$(this).attr('match'), team=$(this).attr('team'), goals=$(this).val();
  $.ajax({
    url: '/admin/resultados',
    type: 'POST',
    dataType: 'json',
    data: {match: match, team: team, goals: goals},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    } else {
      Lobibox.notify(obj.type, {
        title: obj.title,
        sound: true,
        msg: obj.msg
      });
    }
  });
});

// Modal de goles
$('.add-goals').click(function() {
  var match=$(this).attr('match');
  $.ajax({
    url: '/admin/resultados/equipos',
    type: 'POST',
    dataType: 'json',
    data: {match: match},
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {

      $('#error-goals').addClass('d-none');
      $('#team-one div, #team-two div').remove();
      $('#save_goals').attr('match', match);
      $('#team_one_name').text(obj.team_one_name);
      $('#team_two_name').text(obj.team_two_name);

      if (obj.team_one_goals>0) {
        for (var i=obj.team_one_goals-1; i>=0; i--) {
          $("#team-one").append($('<div>', {
            class: "row"
          }).append($('<div>', {
            class: "form-group col-12"
          }).append($('<select>', {
            class: "form-control selectPlayers"
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

      if (obj.team_two_goals>0) {
        for (var i=obj.team_two_goals-1; i>=0; i--) {
          $("#team-two").append($('<div>', {
            class: "row"
          }).append($('<div>', {
            class: "form-group col-12"
          }).append($('<select>', {
            class: "form-control selectPlayers"
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

      $('#team-one .selectPlayers').each(function() {
        $(this).append($('<option>', {
          value: '',
          text: 'Seleccione'
        }));
        for (var i=obj.team_one.length-1; i>=0; i--) {
          $(this).append($('<option>', {
            value: obj.team_one[i].slug,
            text: obj.team_one[i].name
          }));
        }
      });

      $('#team-two .selectPlayers').each(function() {
        $(this).append($('<option>', {
          value: '',
          text: 'Seleccione'
        }));
        for (var i=obj.team_two.length-1; i>=0; i--) {
          $(this).append($('<option>', {
            value: obj.team_two[i].slug,
            text: obj.team_two[i].name
          }));
        }
      });

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

// Guarsar goleadores
$('#save_goals').click(function() {
  $('#error-goals').addClass('d-none');
  var validate=true, num1=0, num2=0, players1=[], players2=[], match=$(this).attr('match');
  $('#team-one .selectPlayers').each(function() {
    players1[num1]=$(this).val();
    if ($(this).val()=="") {
      validate=false;
    }
    num1++;
  });

  $('#team-two .selectPlayers').each(function() {
    players2[num2]=$(this).val();
    if ($(this).val()=="") {
      validate=false;
    }
    num2++;
  });

  if (validate) {
    $.ajax({
      url: '/admin/resultados/goleadores',
      type: 'POST',
      dataType: 'json',
      data: {match: match, players1: players1, players2: players2},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      if (obj.status) {
        $('#modalGoals').modal('hide');
        Lobibox.notify(obj.type, {
          title: obj.title,
          sound: true,
          msg: obj.msg
        });
      } else {
        Lobibox.notify(obj.type, {
          title: obj.title,
          sound: true,
          msg: obj.msg
        });
      }
    });
  } else {
    $('#error-goals').removeClass('d-none');
  }
});

function colorModal(position, color) {
  $("#color").val(color);
  $("#position").val(position);
  $("#modalColors").modal();
}