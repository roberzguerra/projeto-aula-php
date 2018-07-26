<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];

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