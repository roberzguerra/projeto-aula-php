<?php
include '../config.php';

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

    if (isset($_GET['edit']) && $_GET['edit'] == 1
        && isset($_GET['id']) && $_GET['id']) {
            $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id = {$_GET['id']};");
        }

    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (isset($_POST['id']) && $_POST['id'] )  {
        $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id = {$_POST['id']}");
    }

    if (count($listaErros) > 0) {
        include "cadastro-view.php";

    } else if (isset($_POST['id']) && $_POST['id']) {

        $sigla = strtoupper($_POST['sigla']);
        // Executo o update
        $sql = "UPDATE uf 
            SET nome = '{$_POST['nome']}', 
            sigla = '{$sigla}'
            WHERE id = {$_POST['id']};
        ";
        $alterado = update_db($sql);

        //$_SESSION['msg_sucesso'] = "Cidade {$_POST['nome']} alterada com sucesso.";

        alertSuccess("Sucesso.", "Estado {$_POST['nome']} alterado com sucesso.");
        
        redirect("/modulo-estado/");
        
    } else {

        $sigla = strtoupper($_POST['sigla']);
        $sql = "INSERT INTO uf (nome, sigla)
            VALUES ('{$_POST['nome']}', '{$sigla}');";

        $estadoId = insert_db($sql);

        // Variaveis para controle de erros.
        $mensagemSucesso = '';
        $mensagemErro = '';

        if ($estadoId) {
            $mensagemSucesso = "Estado cadastrado com sucesso.";
        } else {
            $mensagemErro = "Erro inesperado.";
        }
        include "cadastro-view.php";
        
    }
}



?>