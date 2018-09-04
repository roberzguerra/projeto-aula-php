<?php
session_start();
// Define o idioma padrão do PHP para Portugues do Brasil
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

// define o timezone (fuso horario) padrao do sistema, para o PHP.
date_default_timezone_set('America/Sao_Paulo');

// Importa o autoload da vendor
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function get_credenciais($valor)
{
    include 'credenciais.php';

    return $config[$valor];
}

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

/**
 * Retorna a URL do site.
 * Se receber uma string por parametro, concatena a string apos 
 *  o nome do site, ex:
 *  echo site_url('/login/');
 *  resultado: "http://aula.com/login/"
 */
function site_url($url='')
{
    return $GLOBALS['SITE_URL'] . $url;
}

// Chave do site utilizada para criar hashs md5.
// Deve ser concatenada com a senha do usuario quando
//  criar o usuario ou autenticar para login, ex:
//  $hashSenha = md5($SITE_HASH . $senha);
$SITE_HASH = 'chave-curso-php-flexxo!';
/**
 * Retorna a string recebida no parametro $senha concatenada com
 *   o valor de $SITE_HASH, criando um hash unico para o meu site.
 */
function site_hash($senha='')
{
    return $GLOBALS['SITE_HASH'] . $senha;
}


function validar_login()
{
    $uri = $_SERVER['REQUEST_URI'];

    // Validar LOGIN:
    if (isset($_COOKIE['login']) && $_COOKIE['login']) {

        $usuario = select_one_db("
            SELECT
                id,
                email
            FROM 
                usuario
            WHERE
                email = '{$_COOKIE['login']}';
        ");

        // Usuario logado
        if ($usuario && (!$uri || $uri == '/')) {
            // Quando nao houver nada na uri (ou seja, depois de aula.com)
            //  manda o usuario para a url aula.com/modulo-pessoa
            redirect("/modulo-pessoa/");
        }
        
        if(!$usuario) {
            redirect("/login/");
        }

    } else {
        
        $urlsPublicas = [
            '/login',
            '/recuperar-senha',
        ];

        // Verifica se o inicio da URI eh diferente de /login OU /recupear-senha
        //  Sendo diferente, direciona o usuario para a paginade login.
        if (strpos($uri, '/login') != 0
            || strpos($uri, '/recuperar-senha') != 0) {
            redirect('/login/');
        }
    }
}

validar_login();
?>




