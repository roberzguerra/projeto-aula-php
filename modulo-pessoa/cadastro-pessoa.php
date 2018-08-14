<?php
include '../config.php';

/**
 * Valida formulario simples
 */
function validarFormulario($post)
{
    // Recebemos uma data_nascimento no $post (no formato dd/mm/AAAA),
    // separamos pelo delimitador '/' e validamos com o checkdate 
    // (retorna false quando a data for invalida e true quando valida)
    //$dataSeparada = explode('/', $post['data_nascimento']);
    //checkdate($dataSeparada[1], $dataSeparada[0], $dataSeparada[2])

    $listaCampos = [
        'primeiro_nome' => "Primeiro nome obrigatório.",
        'segundo_nome' => "Sobrenome obrigatório.",
        'tipo' => "Selecione Professor ou Aluno",
        'email' => "Email obrigatório.",
        'data_nascimento' => "Data nascimento obrigatória.",
        'endereco' => "Endereço obrigatório.",
        'bairro' => "Bairro obrigatório.",
        'numero' => "Número obrigatório.",
        'cep' => "Cep obrigatório.",
        'cidade' => "Cidade obrigatória.",
        'cpf' => "CPF obrigatório.",
        'sexo' => "Sexo obrigatório.",
    ];

    $listaErros = [];

    // Validação dos campos obrigatorios
    foreach($listaCampos as $chaveCampo => $mensagemCampo) {

        if (!isset($post[$chaveCampo]) || !$post[$chaveCampo] ) {
            $listaErros[$chaveCampo] = $mensagemCampo;
        }
    }

    if ( !isset($listaErros['cpf']) && $post['cpf'] && !validarCpf($post['cpf'])) {
        $listaErros['cpf'] = "CPF inválido.";
    }

    if ( !isset($listaErros['email']) && $post['email'] && validarEmail($post['email'])) {
        $listaErros['email'] = "Email inválido.";
    }

    if ( !isset($listaErros['data_nascimento']) && $post['data_nascimento']) {
        $dataNascimento = DateTime::createFromFormat('d/m/Y H:i:s', $post['data_nascimento']." 00:00:00");
        if (! $dataNascimento) {
            $listaErros['data_nascimento'] = "Data nascimento inválida.";
        }
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
    $listaErros = validarFormulario($_POST);
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