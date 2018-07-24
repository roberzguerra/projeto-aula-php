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
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];

    if (!isset($post['nome']) || !$post['nome'] ) {
        $listaErros['nome'] = "Nome obrigatório.";
    }

    if ( !isset($post['uf']) || !$post['uf'] ) {
        $listaErros['uf'] = "Estado obrigatório.";
    }

    return $listaErros;
}


// Busca todos os UFs (estados) do banco 
$listaUf = select_db("SELECT id, nome, sigla FROM uf;");


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulario enviado <br>";
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (count($listaErros) > 0) {
        include "cadastro-view.php";
    } else {
        
        

        $sql = "INSERT INTO cidade (nome, uf_id) 
            VALUES('" . $_POST['nome'] . "', " . $_POST['uf'] . ");";

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