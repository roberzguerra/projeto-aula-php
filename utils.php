<?php

/**
 * Funções úteis do projeto.
 */

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


  
function removerMascaraCpf($valor)
{
    //return preg_replace(["(",")"," ","'","."], [''], $valor);
    return preg_replace(["/\\D+/"], [''], $valor);
}

function adicionarMascaraCpf($valor)
{
    return vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($valor));
}

function validarCpf($cpf)
{

    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT); 
    //Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if ( strlen($cpf) != 11
        || $cpf == '00000000000'
        || $cpf == '11111111111'
        || $cpf == '22222222222'
        || $cpf == '33333333333'
        || $cpf == '44444444444'
        || $cpf == '55555555555'
        || $cpf == '66666666666'
        || $cpf == '77777777777'
        || $cpf == '88888888888'
        || $cpf == '99999999999') {
        return false;
    } else {
        // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

/**
 * Escapa todas as aspas simples (') e duplas (") da string 
 *  recebida no parametro $valor.
 */
function filtrarSql($valor) {

    $valor = str_replace("'", "\'", $valor);
    $valor = str_replace('"', '\"', $valor);
    return $valor;
}

/**
 * Percorre todas as chaves do $_POST para executar o metodo filtrarSql.
 */
function formatarPost($post) {

    foreach($post as $chave => $valor) {
        $post[$chave] = filtrarSql($valor);
    }
    return $post;
}

// Sempre usar comandos "use" nas primeiras linhas do arquivo php.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Envia um email de acordo com os parametros recebidos.
 */
function enviarEmail($emailDestinatario, $nomeDestinatario, $assunto, $corpo)
{
    $retorno = false;
    try {
        // Instancia a classe PHPMailer com as credenciais do email:
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = get_credenciais('email_usuario');
        $mail->Password = get_credenciais('usuario_senha');
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // email do remetente e nome do remetente
        $mail->setFrom('rober.flexxo@gmail.com', "Rober Z Guerra");
        
        // Email do Destinatario, nome do destinatario
        $mail->addAddress($emailDestinatario, $nomeDestinatario);
        $mail->isHTML(true);
        // Assunto do email
        $mail->Subject = $assunto;
        // Corpo do email
        $mail->Body = $corpo;

        $retorno = $mail->send();

    } catch (Exception $e) {
        echo "Erro ao enviar email:";
        echo $e->getMessage();
    }
    
    return $retorno;
}

// Converte strings em padrao url: remove acentos e espacos em branco.
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return null;
  }

  return $text;
}
?>
