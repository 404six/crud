function clear() {
    // limpa valores os fields do CEP
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('estado').value = ("");

}

function callback(conteudo) {

    // checando se houve algum erro
    if (!("erro" in conteudo)) {
        // se não houver erros, atualiza os campos com os valores
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);
    } 
    else {
        // CEP não encontrado
        clear();
        alert("CEP não encontrado.");
        document.getElementById('cep').value = ("");
    }
}

function search(valor) {

    // nova variável "cep" inicializada somente com dígitos
    var cep = valor.replace(/\D/g, '');

    // verifica se campo cep possui valor informado
    if (cep !== "") {

        // expressão regular para validar o CEP
        var validacep = /^[0-9]{8}$/;

        // valida o formato do CEP
        if (validacep.test(cep)) {

            // preenche os campos com "..." enquanto consulta a api viacep
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('estado').value = "...";

            // cria um elemento javascript
            var script = document.createElement('script');

            // sincroniza com o callback
            script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=callback';

            // insere script no documento e carrega o conteúdo
            document.body.appendChild(script);

        } //end if.
        else {
            // cep é inválido
            clear();
            alert("Formato de CEP inválido.");
        }
    }
    else {
        // cep sem valor, limpa formulário
        clear();
    }
}
