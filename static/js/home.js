
function deletarRegistro(btn) {

    console.log('btn: ', btn);
    btn = $(btn);
    var mensagem = btn.attr('data-delete-message');
    var url = btn.attr('data-delete-url');

    if( confirm(mensagem)  ) {
        window.location.href = url;
    }
};


function trocarCidades() {
    console.log("trocarCidades");

    var uf = $('#uf').val();
    var selectCidade = $('#cidade');
    selectCidade.val('');
    selectCidade.find('option').hide();
    if (uf) { 
    
        selectCidade.find('option[data-uf=' + uf + ']').show();
    }
}

// Os codigos dentro do ready serão executados somente depois
// que a página carregar todo o html.
$(document).ready(function(){

    $('#uf').on('change', trocarCidades);
    trocarCidades();

});




