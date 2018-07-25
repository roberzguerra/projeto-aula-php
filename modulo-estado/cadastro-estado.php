<?php
include '../config.php';

function exibirErro($listaErros, $chave)
{
    if ( isset($listaErros[$chave]) && $listaErros[$chave]) {
        return '<span class="text-danger">' . $listaErros[$chave] . '</span>';
    }
    return '';
}

/**
 * Valida se a $sigla recebida eh string de A-Z ou a-z e somente
 * 2 caracateres
 */
function validarSigla($sigla) {
    $padrao = "/^([a-zA-Z]{2})$/";
    if (preg_match($padrao, $sigla)) {
        return true;
    }
    return false;
}


/**
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];

    if (!isset($post['nome']) || !$post['nome'] ) {
        $listaErros['nome'] = "Nome obrigatório.";
    }


    if (!isset($post['sigla']) || !$post['sigla']) {
    // o codigo abaixo é igual ao if acima
    // if (isset($post['sigla']) == false || $post['sigla'] == false) {

        $listaErros['sigla'] = "Informe a sigla do estado.";        

    } else if ( !validarSigla($post['sigla']) ) {
        $listaErros['sigla'] = "Informe uma sigla com duas letras.";
    } 
    return $listaErros;
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (count($listaErros) > 0) {
        include "cadastro-view.php";
    } else {

        $sigla = strtoupper($_POST['sigla']);
        $sql = "INSERT INTO uf (nome, sigla)
            VALUES ('{$_POST['nome']}', '{$sigla}');";

        dd($sql);

        $cidadeId = insert_db($sql);

        // Variaveis para controle de erros.
        $mensagemSucesso = '';
        $mensagemErro = '';

        if ($cidadeId) {
            $mensagemSucesso = "Cidade cadastrada com sucesso.";
        } else {
            $mensagemErro = "Erro inesperado.";
        }
        include "cadastro-view.php";
        
    }
}



?>