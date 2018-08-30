<?php
session_start();
// Define o idioma padrão do PHP para Portugues do Brasil
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

// define o timezone (fuso horario) padrao do sistema, para o PHP.
date_default_timezone_set('America/Sao_Paulo');

// Importa o autoload da vendor
require '../vendor/autoload.php';

// Inclui arquivo de configuração e metodos de conexão com banco de dados.
include 'db.php';

// Inclui arquivo util.php contendo algumas funções de uso comum do sistema.
include 'utils.php';

/**
 * Arquivo de configuração do projeto
 */


// Ativar exibição de erros no PHP */
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$SITE_URL = 'http://aula.com';

// Chave do site utilizada para criar hashs md5.
// Deve ser concatenada com a senha do usuario quando
//  criar o usuario ou autenticar para login, ex:
//  $hashSenha = md5($SITE_HASH . $senha);
$SITE_HASH = 'chave-curso-php-flexxo!';

$uri = $_SERVER['REQUEST_URI'];
// Validar LOGIN:
if (isset($_COOKIE['login']) && $_COOKIE['login']) {
    // Usuario logado
    if (!$uri || $uri == '/') {
        redirect("/modulo-pessoa/");
    }
    
} else {
    // Manda para tela de login
    if ((strpos($uri, '/login') != 0 || strpos($uri, '/login') === false)
        && (strpos($uri, '/recuperar-senha') != 0 || strpos($uri, '/recuperar-senha') === false)) {
        redirect("/login/");
    }
}
?>




