<?php
 
// Pasta onde o arquivo vai ser salvo
$configUpload['pasta'] = 'uploads/perfil/';
 
// Tamanho máximo do arquivo (em Bytes)
$configUpload['tamanho'] = 1024 * 1024 * 4; // Total : 4Mb
 
// Array com as extensões permitidas
$configUpload['extensoes'] = array('jpg','jpeg', 'png');
 
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$configUpload['renomeia'] = true;
 
// Array com os tipos de erros de upload do PHP
$configUpload['erros'] = [
   0 => 'Não houve erro',
   1 => 'O arquivo no upload é maior do que o limite do PHP',
   2 => 'O arquivo ultrapassa o limite de tamanho especifiado no HTML',
   3 => 'O upload do arquivo foi feito parcialmente',
   4 => 'Não foi feito o upload do arquivo',
];
 
// Verifica se houve algum erro com o upload. 
// Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
    die("Não foi possível fazer o upload, erro:<br />" . $configUpload['erros'][$_FILES['arquivo']['error']]);
    exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $configUpload['extensoes']) === false) {
    echo "Envie arquivos nas extensões jpg, jpeg ou png.";

} else if ( $configUpload['tamanho'] < $_FILES['arquivo']['size']) {
    // Faz a verificação do tamanho do arquivo
    echo "Envie arquivos de até 4MB.";
} else {
    // O arquivo passou em todas as verificações, agora movemos para a pasta desejada
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($configUpload['renomeia'] == true) {
        // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nomeFinal = time().'.'.$extensao;
    } else {
        // Mantém o nome original do arquivo
        $nomeFinal = $_FILES['arquivo']['name'];
    }
 
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $configUpload['pasta'] . $nome_final)) {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
        echo "Upload efetuado com sucesso!";
        echo '<br /><a href="' . $configUpload['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
    } else {
        // Não foi possível fazer o upload
        echo "Não foi possível enviar o arquivo, tente novamente.";
    }
 
}
 
?>