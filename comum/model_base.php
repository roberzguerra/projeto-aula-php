<?php
class ModelBase
{

    public function __construct()
    {
    }

    public function setPost($post)
    {
        /*
        Percorre todas as posicoes do post,
        Pega a $chave e procura um atributo da classe que seja igual ao nome da chave
        'primeiro_nome'
        'segundo_nome'
        */
        foreach($post as $chave => $valor) {
            $this->{$chave} = filtrarSql($valor);
        }
    }
}
?>
