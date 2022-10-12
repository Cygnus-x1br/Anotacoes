$(function () {
  $('form').ready(function () {
    $('.valor').mask('000000000.00', { reverse: true });
    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.ie').mask('000.000.000.000');
    $('.taxa').mask('000.0000', { reverse: true });
    $('.taxa2').mask('000.00', { reverse: true });
    // $('.tel').mask('(00) 0?0000-0000');

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11
          ? '(00) 00000-0000'
          : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function (val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        },
      };

    $('.tel').mask(SPMaskBehavior, spOptions);
    $('.cep').mask('00000-000');
  });

  $('#tipoTel').change(() => {
    if ($('#tipoTel').val() != 'cel') {
      $('#mensagens').css('display', 'none');
    } else {
      $('#mensagens').css('display', 'flex');
    }
  });

  $('button#editarComentario').click(function (e) {
    e.preventDefault();

    $('div#comentario').toggle();
    $('div#editaComentario').toggle();
    if ($('button#editarComentario').html() == 'Editar') {
      $('button#editarComentario').html('Cancelar');
    } else if ($('button#editarComentario').html() == 'Cancelar') {
      $('button#editarComentario').html('Editar');
    }
  });

  $('button#editarParecer').click(function (e) {
    e.preventDefault();

    $('div#parecerSelecao').toggle();
    $('div#editaParecer').toggle();
    if ($('button#editarParecer').html() == 'Processo de seleção') {
      $('button#editarParecer').html('Cancelar');
    } else if ($('button#editarParecer').html() == 'Cancelar') {
      $('button#editarParecer').html('Processo de seleção');
    }
  });

  $('input#MOT').click(function (e) {
    if ($('input#MOT').prop('checked') == true) {
      $('div.taxasMOT').css('display', 'block');
    } else if ($('input#MOT').prop('checked') == false) {
      $('div.taxasMOT').css('display', 'none');
    }
  });

  $('input#MO3').click(function (e) {
    if ($('input#MO3').prop('checked') == true) {
      $('div.taxasMO3').css('display', 'block');
    } else if ($('input#MO3').prop('checked') == false) {
      $('div.taxasMO3').css('display', 'none');
    }
  });

  $('input#RES').click(function (e) {
    if ($('input#RES').prop('checked') == true) {
      $('div.taxasRES').css('display', 'block');
    } else if ($('input#RES').prop('checked') == false) {
      $('div.taxasRES').css('display', 'none');
    }
  });
  $(document).ready(function (e) {
    if ($('input#MOT').prop('checked') == true) {
      $('div.taxasMOT').css('display', 'block');
    } else if ($('input#MOT').prop('checked') == false) {
      $('div.taxasMOT').css('display', 'none');
    }
    if ($('input#MO3').prop('checked') == true) {
      $('div.taxasMO3').css('display', 'block');
    } else if ($('input#MO3').prop('checked') == false) {
      $('div.taxasMO3').css('display', 'none');
    }
    if ($('input#RES').prop('checked') == true) {
      $('div.taxasRES').css('display', 'block');
    } else if ($('input#RES').prop('checked') == false) {
      $('div.taxasRES').css('display', 'none');
    }
  });
  $('button#sendChangePasswd').click(function (e) {
    if ($('#recipient-passwd').val() !== $('#recipient-passwd2').val()) {
      $('div#verificaPasswdAlterada').css('display', 'block');
      e.preventDefault();
    } else {
      $('#alteraSenha').submit(function (e) {
        return;
      });
    }
  });
  $('button#mostraSenha').click(function (e) {
    if ($('input#recipient-old-pass').attr('type') == 'password') {
      $('input#recipient-old-pass').attr('type', 'text');
      $('input#recipient-passwd').attr('type', 'text');
      $('input#recipient-passwd2').attr('type', 'text');
    } else {
      $('input#recipient-old-pass').attr('type', 'password');
      $('input#recipient-passwd').attr('type', 'password');
      $('input#recipient-passwd2').attr('type', 'password');
    }
  });
  $('button#mostraSenhaLogin').click(function (e) {
    if ($('input#exampleInputPassword1').attr('type') == 'password') {
      $('input#exampleInputPassword1').attr('type', 'text');
      $('button#mostraSenhaLogin').html('<i class="fa-regular fa-eye"></i>');
    } else {
      $('input#exampleInputPassword1').attr('type', 'password');
      $('button#mostraSenhaLogin').html(
        '<i class="fa-regular fa-eye-slash"></i>',
      );
    }
  });
  $('input#aprovado').click(function (e) {
    if ($('input#aprovado').val() == 'S') {
      $('div#showVagas').toggle();
    }
  });
  $('#passwordCandidato').blur(function (e) {
    if ($('#passwordCandidato').val().length < 6) {
      $('div#alertPassLenght').html('A senha deve ter ao menos 6 caracteres');
      $('#passwordCandidato').focus();
    } else {
      $('div#alertPassLenght').html('');
    }
  });
  $('#passwordCandidato2').blur(function (e) {
    if ($('#passwordCandidato2').val().length < 6) {
      $('div#alertPassLenght').html('A senha deve ter ao menos 6 caracteres');
      $('#passwordCandidato2').focus();
    } else {
      $('div#alertPassLenght').html('');
    }
  });
  $('#recipient-passwd').blur(function (e) {
    if ($('#recipient-passwd').val().length < 6) {
      $('div#alertPassLenghtChange').html(
        'A senha deve ter ao menos 6 caracteres',
      );
      $('#recipient-passwd').focus();
    } else {
      $('div#alertPassLenghtChange').html('');
    }
  });
  $(document).ready(function () {
    $('.select-filter').select2();
  });
});
