function pesquisaCEP(cep) {
  let message = document.querySelector('#load');
  if (cep.length === 9) {
    let request = 'https://viacep.com.br/ws/' + cep + '/json/';
    let ajax = new XMLHttpRequest();
    ajax.open('GET', request);
    ajax.onreadystatechange = function () {
      if (ajax.readyState === 4 && ajax.status === 200) {
        let endCompleto = JSON.parse(ajax.responseText);
        if (endCompleto.erro === 'true') {
          message.style.display = 'block';
          message.innerHTML = 'CEP inválido';
        } else {
          message.innerHTML = '';
          document.getElementById('endereco').value = endCompleto.logradouro;
          document.getElementById('bairro').value = endCompleto.bairro;
          document.getElementById('cidade').value = endCompleto.localidade;
          document.getElementById('uf').value = endCompleto.uf;
        }
      }
    };
    ajax.send();
  } else {
    if ((message.style.display = 'block')) {
      message.style.display = 'none';
      document.getElementById('endereco').value = '';
      document.getElementById('bairro').value = '';
      document.getElementById('cidade').value = '';
      document.getElementById('uf').value = '';
    }
  }
}
