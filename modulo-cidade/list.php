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
    /*
    if (isset($_SESSION['msg_sucesso']) && $_SESSION['msg_sucesso']) {
        
        <div class="alert alert-success">
            <?php echo $_SESSION['msg_sucesso']; ?>
        </div>
        
        unset($_SESSION['msg_sucesso']);
    }
    */

    ?>
    <a href="/modulo-cidade/cadastro-cidade.php">
        <button class="btn btn-default">Nova Cidade</button>
    </a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaCidades as $cidade) { ?>
                <tr>
                    <td><?php echo $cidade->cidade_id; ?></td>
                    <td><?php echo $cidade->cidade_nome; ?></td>
                    <td><?php echo "{$cidade->uf_nome} ({$cidade->uf_sigla})"; ?></td>
                    <td>
                        <a href="<?php echo "/modulo-cidade/cadastro-cidade.php?edit=1&id={$cidade->cidade_id}"; ?>">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar a cidade {$cidade->cidade_nome} ?"; ?>" data-delete-url="<?php echo "/modulo-cidade?delete=1&id={$cidade->cidade_id}"; ?>"  onclick="deletarRegistro(this);">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    </div>
</div>


<script type="text/javascript">
/*
function deletarRegistro(id) {

    var ok = confirm("Deseja deletar o registro ID = " + id + " ?");
    if (ok) {
        window.location.href = "/modulo-cidade?delete=1&id=" + id;
    }
}
*/
</script>
<?php
include "../comum/footer.php";
?>
