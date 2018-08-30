<?php 
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Abre a pagina de recuperação de senha
    
    include 'view.php';

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Envia o email para recuperacao de senha

    if (isset($_POST['email']) && $_POST['email']) {

        $usuario = select_one_db("
            SELECT 
                id,
                nome,
                email 
            FROM 
                usuario 
            WHERE
                email='{$_POST['email']}';");

        if ($usuario && isset($usuario->email)) {
            $hashRecuperarSenha = md5($SITE_HASH . $usuario->email);

            $linkRecuperarSenha = $SITE_URL . "/recuperar-senha/recuperar.php?id={$hashRecuperarSenha}";
            $corpoEmail = "
                Olá {$usuario->nome}.<br>
                <br>
                <a href=\"{$linkRecuperarSenha}\">Clique aqui para recuperar sua senha.</a>
            ";
            $enviado = enviarEmail(
                $usuario->email, // email destinatario
                $usuario->nome,  // Nome destinatario
                "Recuperar Senha", // Assunto
                $corpoEmail // Corpo do email
            );

            if ($enviado) {

                $alterado = update_db("
                    UPDATE
                        usuario 
                    SET 
                        recuperar_senha = '{$hashRecuperarSenha}' 
                    WHERE 
                        id={$usuario->id};");

                if ($alterado) {

                    $mensagemSucesso = "Enviamos um email com o link de recuperação de senha para {$usuario->email}, por favor verifique seu email.";
                } else {

                    $mensagemErro = "Ops. Ocorreu um erro inesperado ao tentar recuperar sua senha.";
                }
            } else {
                $mensagemErro = "Ops. Ocorreu um erro inesperado ao enviar o email de recuperação de senha.";
            }
        }
    }
    include 'view.php';
}

?>