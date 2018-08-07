<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    $mensagemSucesso = "";


    if (isset($_GET['delete']) && isset($_GET['id'])
        && $_GET['delete'] == '1' && $_GET['id']) {
        
        $uf = select_one_db("SELECT nome FROM uf WHERE id={$_GET['id']};");
        $deletado = deletarRegistro($_GET['id'], 'uf');

        if ($deletado) {
            $_SESSION['msg_sucesso'] = [
                'title' => 'Sucesso.',
                'icon' => 'fa fa-warning',
                'message' => "Estado {$uf->nome} removido com sucesso.",
            ];
        } else {
            $_SESSION['msg_erro'] = [
                'title' => 'Erro.',
                'icon' => 'fa fa-warning',
                'message' => "Erro ao remover o estado.",
            ];
        }
        redirect('/modulo-estado/');
    }

    // Fazer a busca das cidades e exibir a pagina list.php
    $listaUfs = select_db("
        SELECT 
            id,
            nome,
            sigla
        FROM uf
        ORDER BY uf.nome ASC;
    ");
    
    include "list.php";

}


?>