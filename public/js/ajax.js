function listaCidades(selEstadoID) {
  $.ajax({
    type: 'GET',
    data: 'selEstadoId=' + selEstadoID,
    url: './php/lista_cidades.php',
    async: false,
  })
    .done(function (data) {
      var cidade = $.parseJSON(data);
      // console.log(cidade);
      var cidades = '';
      $.each(cidade, function (chave, valor) {
        cidades +=
          '<option value="' +
          valor.IDCIDADE +
          '">' +
          valor.nomeCidade +
          '</option>';
      });
      $('select#cidade').html(cidades);
    })
    .fail(function () {
      console.log('Erro');
    });
}
