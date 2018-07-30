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
                        <button class="btn btn-primary">Editar</button>
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
