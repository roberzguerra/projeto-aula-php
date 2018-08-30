<?php
include '../comum/head.php';
?>
<style type="text/css">
footer.sticky-footer {
        width: 100%;
}
</style>

 <div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header">Alterar Senha</div>
    <div class="card-body">

    <?php if (isset($usuario) && $usuario) { ?>
        <form action="/recuperar-senha/recuperar.php?id=<?php echo $_GET['id'];?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
                <div class="form-label-group">
                <label for="senha">Informe sua nova senha</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="required" autofocus="autofocus">
                </div>
            </div>

            <div class="form-group">
                <div class="form-label-group">
                <label for="senha2">Confirme sua nova senha</label>
                <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Senha" required="required">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    <?php } else { ?>
        <div class="alert alert-danger">Usuário não encontrado.</div
    <?php } ?>

    <?php if (isset($mensagemSucesso) && $mensagemSucesso) { ?>
        <div class="alert alert-success">
        <?php echo $mensagemSucesso; ?>
        </div>
    <?php } ?>

    <?php if (isset($mensagemErro) && $mensagemErro) { ?>
        <div class="alert alert-danger">
        <?php echo $mensagemErro; ?>
        </div>
    <?php } ?>

    </div>
    </div>
</div>

<?php
include '../comum/footer.php';
?>