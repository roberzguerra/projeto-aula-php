<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Se o ID existir na coluna 'recuperar_senha' da tabela usuario,
    // exibe a pagina para trocar a senha.

    if (isset($_GET['id']) && $_GET['id']) {
        
        $id = $_GET['id'];

        $usuario = select_one_db("
            SELECT 
                id, 
                nome
            FROM
                usuario
            WHERE
                recuperar_senha = '{$id}';
        ");
    }
    include "recuperar_senha_view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Executa a troca de senha.

    if (isset($_POST['id']) && $_POST['id']
        && isset($_POST['senha']) && $_POST['senha']
        && isset($_POST['senha2']) && $_POST['senha2']) {
            
            $id = $_POST['id'];
            $senha = $_POST['senha'];
            $senha2 = $_POST['senha2'];

            $usuario = select_one_db("
                SELECT 
                    id, 
                    nome
                FROM
                    usuario
                WHERE
                    recuperar_senha = '{$id}';
            ");

            if ($senha === $senha2) {
                // Salvo a nova senha no banco
                $hashSenha = md5($SITE_HASH . $senha);
                $alterado = update_db("
                    UPDATE
                        usuario
                    SET
                        senha='{$hashSenha}',
                        recuperar_senha=NULL
                    WHERE
                        recuperar_senha='{$id}';
                ");
                if ($alterado) {

                    alertSuccess("Senha alterada com sucesso.", '', 3000);
                    redirect('/login/');
                } else {
                    $mensagemErro = "Ops. Erro inesperado ao tentar alterar a senha.";
                }

            } else {
                $mensagemErro = "As senhas devem ser idênticas.";
            }
        } else {
            $mensagemErro = "Erro inesperado. Tente novamente.";
        }

    include "recuperar_senha_view.php";
}
?>