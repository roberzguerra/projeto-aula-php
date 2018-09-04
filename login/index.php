<?php
include "../config.php";

function logar($email, $senha)
{

    // senha md5 1234: 81dc9bdb52d04dc20036dbd8313ed055
    // verifica no banco
    // Quando for salvar a senha, gere o hash md5 adicionando mais strings na senha, exemplo: md5('CursoFlexoo'. $email . $senha)
    $hashSenha = md5( site_hash($senha) );
    $usuario = select_one_db("
        SELECT 
            senha 
        FROM 
            usuario 
        WHERE email = '{$email}';
    "); 
    
    if ($usuario && $usuario->senha == $hashSenha) {
        // parametros:
        // 1 - nome do cookie
        // 2 - valor
        // 3 - tempo de validade em segundos:
        //      time():retorna a quantidade de segundos totais desde 1/1/1970.
        //      +(60*60*24*30): total de segundos em 1 mes
        // 4 - Caminho "/" para valer em todo o site
        // 5 - nome do dominio
        setcookie("login", $email, time()+60*60*24*30, "/");
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Abre a pagina de login
    
    include 'view.php';

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    if ($email && $senha && logar($email, $senha, $SITE_HASH, $SITE_URL)) {
        redirect('/modulo-pessoa/');
    } else {
        $mensagemErro = "Email ou senha incorretos.";
    }
    
    include 'view.php';
    //    setcookie("login", "email do usuario");
    //    redirect('/cadastro-pessoa/');

}

?>