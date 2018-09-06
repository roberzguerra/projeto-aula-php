<?php
include '../config.php';
include "pessoa.php";
/*
// Manipulando datas com DateTime:
$data = DateTime::createFromFormat('d/m/Y H:i:s', '10/08/1990 00:00:00');
dd($data->format('Y-m-d H:i:s.u'));
*/

function uploadImagemPerfil($file, $novoNome='', $diretorio='/uploads/perfil/')
{
    $retorno = [
        'status' => false,
        'mensagem' => 'Erro ao enviar o arquivo.',
        'nome_arquivo' => '',
    ];

    // Pasta onde o arquivo vai ser salvo
    $configUpload['pasta'] = $_SERVER['DOCUMENT_ROOT'] . $diretorio;
    
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
    if ($file['arquivo']['error'] != 0) {
        $retorno['mensagem'] = "Não foi possível fazer o upload, erro:<br />" . $configUpload['erros'][$file['arquivo']['error']];
        return $retorno;
    }
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

    // Faz a verificação da extensão do arquivo
    $arrayNome = explode('.', $file['arquivo']['name']);
    $extensao = strtolower($arrayNome[ count($arrayNome)-1 ]);
    
    if (array_search($extensao, $configUpload['extensoes']) === false) {
        $retorno['mensagem'] = "Envie arquivos nas extensões jpg, jpeg ou png.";

    } else if ( $configUpload['tamanho'] < $file['arquivo']['size']) {
        // Faz a verificação do tamanho do arquivo
        $retorno['mensagem'] = "Envie arquivos de até 4MB.";
    } else {
        // O arquivo passou em todas as verificações, agora movemos para a pasta desejada
        // Primeiro verifica se deve trocar o nome do arquivo
        if ($configUpload['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            if ($novoNome) {
                $nomeFinal = $novoNome.'.'.$extensao;
            } else {
                $nomeFinal = time().'.'.$extensao;
            }
        } else {
            // Mantém o nome original do arquivo
            $nomeFinal = $file['arquivo']['name'];
        }
    
        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($file['arquivo']['tmp_name'], $configUpload['pasta'] . $nomeFinal)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            $retorno['mensagem'] = "Arquivo enviado com sucesso!";
            $retorno['nome_arquivo'] = $nomeFinal;
            $retorno['status'] = true;
        } else {
            // Não foi possível fazer o upload
            $retorno['mensagem'] = "Não foi possível enviar o arquivo, tente novamente.";
        }
    
    }

    return $retorno;
}

/**
 * Valida formulario simples
 */
function validarFormulario($post)
{
    // Recebemos uma data_nascimento no $post (no formato dd/mm/AAAA),
    // separamos pelo delimitador '/' e validamos com o checkdate 
    // (retorna false quando a data for invalida e true quando valida)
    //$dataSeparada = explode('/', $post['data_nascimento']);
    //checkdate($dataSeparada[1], $dataSeparada[0], $dataSeparada[2])

    $listaCampos = [
        'primeiro_nome' => "Primeiro nome obrigatório.",
        'segundo_nome' => "Sobrenome obrigatório.",
        'tipo' => "Selecione Professor ou Aluno",
        'email' => "Email obrigatório.",
        'data_nascimento' => "Data nascimento obrigatória.",
        'endereco' => "Endereço obrigatório.",
        'bairro' => "Bairro obrigatório.",
        'numero' => "Número obrigatório.",
        'cep' => "Cep obrigatório.",
        'cidade' => "Cidade obrigatória.",
        'cpf' => "CPF obrigatório.",
        'sexo' => "Sexo obrigatório.",
    ];

    $listaErros = [];

    // Validação dos campos obrigatorios
    foreach($listaCampos as $chaveCampo => $mensagemCampo) {

        if (!isset($post[$chaveCampo]) || !$post[$chaveCampo] ) {
            $listaErros[$chaveCampo] = $mensagemCampo;
        }
    }

    if ( !isset($listaErros['cpf']) && $post['cpf'] && !validarCpf($post['cpf'])) {
        $listaErros['cpf'] = "CPF inválido.";

    } else if ($post['cpf']) {
        $cpfSemMascara = removerMascaraCpf($post['cpf']);

        $where = '';
        if (isset($post['id']) && $post['id']) {
            $where = "AND pessoa.id<>{$post['id']}";
        }

        $resultado = select_one_db("
            SELECT 
                COUNT(id) AS count 
            FROM 
                pessoa 
            WHERE 
                cpf='{$cpfSemMascara}'
                $where;
            ");
        if ($resultado->count > 0) {
            $listaErros['cpf'] = "CPF já cadastrado.";
        }
    }

    if ( !isset($listaErros['email']) && $post['email'] && !validarEmail($post['email'])) {
        $listaErros['email'] = "Email inválido.";
    } else if ($post['email']) {
        
        $where = '';
        if (isset($post['id']) && $post['id']) {
            $where = " AND id <> {$post['id']}";
        }

        $resultado = select_one_db("
            SELECT 
                COUNT(id) AS count 
            FROM 
                pessoa 
            WHERE 
                email='{$post['email']}'
                $where
            ;");
        if ($resultado->count > 0) {
            $listaErros['email'] = "Email já cadastrado.";
        }
    }

    if ( !isset($listaErros['data_nascimento']) && $post['data_nascimento']) {
        $dataNascimento = DateTime::createFromFormat('d/m/Y H:i:s', $post['data_nascimento']." 00:00:00");
        if (! $dataNascimento) {
            $listaErros['data_nascimento'] = "Data nascimento inválida.";
        }
    }


    return $listaErros;
}

$listaUfs = select_db("SELECT id, nome, sigla FROM uf ORDER BY nome ASC;");

$pessoa = new Pessoa();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];

    if (isset($_GET['edit']) && $_GET['edit'] == 1
        && isset($_GET['id']) && $_GET['id']) {
            // Busca a pessoa do banco de dados
            $pessoaBd = select_one_db("
                SELECT 
                    pessoa.id AS id,
                    pessoa.primeiro_nome AS primeiro_nome,
                    pessoa.segundo_nome AS segundo_nome,
                    pessoa.email AS email,
                    pessoa.cpf AS cpf,
                    pessoa.data_nascimento AS data_nascimento,
                    pessoa.endereco AS endereco,
                    pessoa.bairro AS bairro,
                    pessoa.numero AS numero,
                    pessoa.cep AS cep,
                    pessoa.tipo AS tipo,
                    pessoa.sexo AS sexo,
                    pessoa.cidade_id AS cidade_id,
                    pessoa.imagem_perfil,
                    uf.id AS uf_id
                FROM pessoa 
                    INNER JOIN cidade ON(cidade.id=pessoa.cidade_id) 
                    INNER JOIN uf ON(uf.id=cidade.uf_id)
                WHERE 
                    pessoa.id = {$_GET['id']};
            ");

            $pessoa = new Pessoa($pessoaBd);
        }

    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $pessoa->setPost($_POST);
    // Iicializo lista erros
    $listaErros = [];

    if ($_FILES) {
        // Converte o nome da pessoa em caracteres utilizaveis como URL
        // para salvar a imagem com novo nome
        $nomeImagem = slugify($pessoa->getNomeCompleto() . '-' . $pessoa->id);

        $retornoUpload = uploadImagemPerfil($_FILES, $nomeImagem);
        if ($retornoUpload['status'] === true) {
            $pessoa->imagem_perfil = $retornoUpload['nome_arquivo'];
        } else {
            $listaErros['arquivo'] = $retornoUpload['mensagem'];
        }
        
    }

    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    // array_merge mescla o primeiro array com o segundo
    $listaErros = array_merge($listaErros, validarFormulario($_POST));
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (isset($_POST['id']) && $_POST['id'] )  {
        $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id = {$_POST['id']}");
    }

    if (count($listaErros) > 0) {
        include "cadastro-view.php";

    } else if (isset($_POST['id']) && $_POST['id']) {

        $dataNascimentoBanco = $pessoa->data_nascimento->format('Y-m-d') . ' 00:00:00';

        // Executo o update
        $sql = "UPDATE pessoa
            SET
                primeiro_nome = '{$pessoa->primeiro_nome}',
                segundo_nome = '{$pessoa->segundo_nome}',
                email = '{$pessoa->email}',
                cpf = '{$pessoa->cpf}',
                data_nascimento = '{$dataNascimentoBanco}',
                tipo = {$pessoa->tipo},
                endereco = '{$pessoa->endereco}',
                cep = '{$pessoa->cep}',
                bairro = '{$pessoa->bairro}',
                numero = '{$pessoa->numero}',
                cidade_id = {$pessoa->cidade_id},
                sexo = '{$pessoa->sexo}',
                imagem_perfil = '{$pessoa->imagem_perfil}'
            WHERE id = {$pessoa->id};
        ";
        
        $alterado = update_db($sql);
        
        alertSuccess("Sucesso.", "Pessoa {$pessoa->getNomeCompleto()} alterada com sucesso.");
        
        redirect("/modulo-pessoa/");
        
    } else {
        //$post = formatarPost($_POST);

        $dataNascimentoBanco = $pessoa->data_nascimento->format('Y-m-d') . ' 00:00:00';

        $sql = "INSERT INTO pessoa (
            primeiro_nome,
            segundo_nome,
            email,
            cpf,
            data_nascimento,
            tipo,
            endereco,
            cep,
            bairro,
            numero,
            cidade_id,
            sexo,
            imagem_perfil
        ) VALUES (
            '{$pessoa->primeiro_nome}',
            '{$pessoa->segundo_nome}',
            '{$pessoa->email}',
            '{$pessoa->cpf}',
            '{$dataNascimentoBanco}',
            {$pessoa->tipo},
            '{$pessoa->endereco}',
            '{$pessoa->cep}',
            '{$pessoa->bairro}',
            '{$pessoa->numero}',
            {$pessoa->cidade_id},
            '{$pessoa->sexo}',
            '{$pessoa->imagem_perfil}'
        );";
        
        $pessoaId = insert_db($sql);

        if ($pessoaId) {
            alertSuccess("Sucesso.", "Pessoa {$_POST['primeiro_nome']} acadastrado com sucesso.");
        } else {
            alertError("Erro.", "Erro ao cadastrar pessoa.");
        }
        include "cadastro-view.php";
    }
}

?>