<?php
include '../comum/head.php';
include '../comum/side-menu.php';
?>

<div class="content-wrapper">
	<div class="container-fluid">

	<?php
	include "../comum/migalhas.php";
	?>

    <?php
    if ($mensagemSucesso) {
        ?>
        <div class="alert alert-success">
            <?php echo $mensagemSucesso; ?>
        </div>
        <?php
    }

    if ($listaErros) {
        ?>
        <div class="alert alert-danger">
            <?php echo exibirErro($listaErros, 'delete'); ?>
        </div>
        <?php
    }

    ?>
    <a href="/modulo-pessoa/cadastro-pessoa.php">
        <button class="btn btn-default">Nova pessoa</button>
    </a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th><a href="?order=primeiro_nome&order_type=<?php echo (isset($_GET['order_type']) && $_GET['order_type'] == 'ASC') ? 'DESC' : 'ASC'; ?>">Nome</a></th>
                <th><a href="?order=cpf&order_type=<?php echo (isset($_GET['order_type']) && $_GET['order_type'] == 'ASC') ? 'DESC' : 'ASC'; ?>">CPF</a></th>
                <th><a href="?order=email&order_type=<?php echo (isset($_GET['order_type']) && $_GET['order_type'] == 'ASC') ? 'DESC' : 'ASC'; ?>">Email</a></th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaPessoas as $pessoa) { ?>
                <tr>
                    <td><?php echo $pessoa->id; ?></td>
                    <td><?php echo "{$pessoa->primeiro_nome} {$pessoa->segundo_nome}"; ?></td>
                    <td><?php echo adicionarMascaraCpf($pessoa->cpf); ?></td>
                    <td><?php echo $pessoa->email;?></td>
                    <td>
                        <a href="<?php echo "/modulo-pessoa/cadastro-pessoa.php?edit=1&id={$pessoa->id}"; ?>">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar a pessoa {$pessoa->primeiro_nome} ?"; ?>" data-delete-url="<?php echo "/modulo-pessoa?delete=1&id={$pessoa->id}"; ?>"  onclick="deletarRegistro(this);">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div>
        <?php
        // Exibe os links Anterior - PaginaAtual - Proximo
        // na tela.
        $pagina += 1;
        if($pagina > 1){
            $paginaAnterior = $pagina - 1;
            echo "<a href=\"?p={$paginaAnterior}\">Anterior</a>";

        }
        // Exibe a pagina atual.
        echo " - {$pagina} - ";

        if($pagina <= $total) {
            $proximaPagina = $pagina + 1;
            echo "<a href=\"?p={$proximaPagina}\">Próximo</a>";
        }
        ?>
    </div>

    </div>
</div>

<?php
include "../comum/footer.php";
?>
