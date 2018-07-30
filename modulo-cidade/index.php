<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    $mensagemSucesso = "";

    // Deleta o registro se receber os parametros delete=1
    // E id=<id do registro a ser deletado>
    if (isset($_GET['delete']) && isset($_GET['id'])
        && $_GET['delete'] == '1' && $_GET['id']) {
        
        $lista = select_db("SELECT id, nome FROM cidade WHERE id = " . $_GET['id']);
        if (count($lista) > 0 && $lista[0]->id) {

            $deletado = delete_db("DELETE FROM cidade WHERE id = " . $_GET['id']);
            if ($deletado) {
                $mensagemSucesso = "Cidade {$lista[0]->nome} removida com sucesso.";
            } else {
                $listaErros['delete'] = "Erro ao remover o registro id = {$_GET['id']}.";
            }
        }
    }

    // Fazer a busca das cidades e exibir a pagina list.php
    $listaCidades = select_db("
        SELECT 
            A.id AS cidade_id,
            A.nome AS cidade_nome,
            B.id AS uf_id,
            B.nome AS uf_nome,
            B.sigla AS uf_sigla
        FROM
            cidade AS A 
            INNER JOIN uf AS B ON(B.id = A.uf_id)
        ORDER BY 
            A.id ASC;
    ");

    include "list.php";

}


?>