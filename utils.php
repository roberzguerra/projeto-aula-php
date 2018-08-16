<?php
/**
 * Funções úteis do projeto.
 */

/**
 * Retorna a URL raiz do site atual;
 * 
 */
function site_url()
{
    return $SITE_URL;
}

/**
 * Dump and Die : debugar codigo interrompendo a execução.
 */
function dd($valor) 
{
    echo '<pre style="background-color: #FFF !important; color: #000 !important; ">';
    var_dump($valor);
    echo '</pre>';
    die;
}

/**
 * Dump: debugar codigo sem interromper o processo.
 */
function d($valor)
{
    echo '<pre style="background-color: #FFF !important; color: #000 !important; ">';
    var_dump($valor);
    echo '</pre>';
}

/**
 * Valida o email.
 * Através de expressões regulares do PHP.
 */
function validarEmail($email) {
    $conta = "/^[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;

    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

/**
 * Exibe erros de um array pegando pela chave.
 */
function exibirErro($listaErros, $chave)
{
    if ( isset($listaErros[$chave]) && $listaErros[$chave]) {
        return '<span class="text-danger">' . $listaErros[$chave] . '</span>';
    }
    return '';
}

function deletarRegistro($id, $tableName) {
    // String do SQL utilizando chaves ({}) para concatenar.
    //$lista = select_db("SELECT id, nome FROM {$tableName} WHERE id = {$id}");

    // String do SQL utilizando ponto (.) para concatenar.
    return delete_db("DELETE FROM {$tableName} WHERE id = {$id}");
}

/**
 * Direciona o usuario para a $url recebida no parametro.
 */
function redirect($url)
{
    die("<script>window.location.href = '{$url}';</script>");
}


function alertSuccess($titulo, $mensagem, $delay=3000, $icone='fa fa-warning') {
    $_SESSION['msg_sucesso'] = [
        'title' => $titulo,
        'icon' => $icone,
        'message' => $mensagem,
        'type' => "success",
        'delay' => $delay,
    ];
}

function alertError($titulo, $mensagem, $delay=3000, $icone='fa fa-warning') {
    $_SESSION['msg_erro'] = [
        'title' => $titulo,
        'icon' => $icone,
        'message' => $mensagem,
        'type' => "danger",
        'delay' => $delay,
    ];
}

/**
 * Verifica se a requisição é Ajax.
 * Se for Ajax retorna true.
 * Se não retorna false.
 */
function checkAjax() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        return true;
    }
    return false;
  }

?>
