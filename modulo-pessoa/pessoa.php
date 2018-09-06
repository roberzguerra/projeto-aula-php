<?php
include "../comum/model_base.php";

class Pessoa extends ModelBase
{
    public $id;
    public $primeiro_nome;
    public $segundo_nome;
    public $email;
    public $cpf;
    public $data_nascimento; // Deve ser um objeto DateTime
    public $endereco;
    public $bairro;
    public $numero;
    public $cep;
    public $tipo;
    public $sexo;
    public $imagem_perfil;

    // Chaves estrangeiras
    public $uf_id;
    public $cidade_id;
    
    
    
    /**
     * Construtor da classe.
     * Recebe todos os parametros desejados no momento da instancia da classe,
     * exemplo de instancia de classe:
     * $pessoa = new Pessoa($pessoaBd);
     */
    public function __construct($pessoaDb=null)
    {

        if ($pessoaDb) {

            $listaAtributos = get_object_vars($pessoaDb);
            parent::setPost($listaAtributos);
            /*
            $this->id = (int) $pessoaDb->id;
            $this->primeiro_nome = $pessoaDb->primeiro_nome;
            $this->segundo_nome = $pessoaDb->segundo_nome;
            $this->email = $pessoaDb->email;
            $this->cpf = (string) $pessoaDb->cpf;
            $this->endereco = $pessoaDb->endereco;
            $this->bairro = $pessoaDb->bairro;
            $this->numero = $pessoaDb->numero;
            $this->cep = $pessoaDb->cep;
            $this->tipo = (int) $pessoaDb->tipo;
            $this->sexo = $pessoaDb->sexo;
            $this->imagem_perfil = $pessoaDb->imagem_perfil;
            */
            // Data de nascimento do banco veio no formato '20010-10-01 00:00:00'
            // Entao transformamos ela em um objeto DateTime
            if (array_key_exists('data_nascimento', $listaAtributos)) {
                $this->data_nascimento = DateTime::createFromFormat('Y-m-d H:i:s', $pessoaDb->data_nascimento);
            }

            if (array_key_exists('uf_id', $listaAtributos)) {
                $this->uf_id = $pessoaDb->uf_id;
            }
            if (array_key_exists('cidade_id', $listaAtributos)) {
                $this->cidade_id = $pessoaDb->cidade_id;
            }
        }

    }

    public function getCpfFormatado() {        
        $retorno = '';
        if ($this->cpf) {
            $retorno = adicionarMascaraCpf($this->cpf);
        }
        return $retorno;
    }

    public function getDataNascimentoFormatada()
    {
        $retorno = '';
        if ($this->data_nascimento) {
            $retorno = $this->data_nascimento->format('d/m/Y');
        }
        return $retorno;
    }

    public function getNomeCompleto()
    {
        return "{$this->primeiro_nome} {$this->segundo_nome}";
    }

    public function setPost($post) 
    {
        // Chama o metodo setPost da classe pai (ModelBase)
        parent::setPost($post);

        if (isset($post['data_nascimento'])) {
            $this->data_nascimento = DateTime::createFromFormat('d/m/Y', $post['data_nascimento']);
        }
        if (isset($post['cpf'])) {
            $this->cpf = removerMascaraCpf($post['cpf']);
        }
        if (isset($post['uf'])) {
            $this->uf_id = $post['uf'];
        }
        if (isset($post['cidade'])) {
            $this->cidade_id = $post['cidade'];
        }
    }

    function getImagemPerfilCaminho()
    {
        if ($this->imagem_perfil) {
            return '/uploads/perfil/' . $this->imagem_perfil;
        } else {
            return null;
            // Caso deseje exibir uma imagem padrao quando nao houver imagem_perfil:
            // return '/imagens/imagem-padrao.jpg';
        }
    }
}


?>