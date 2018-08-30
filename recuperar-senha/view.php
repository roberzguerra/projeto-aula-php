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
    <div class="card-header">Recuperar senha</div>
    <div class="card-body">
        <form action="/recuperar-senha/" method="POST">
            <div class="form-group">
                <div class="form-label-group">
                <label for="email">Informe seu email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
                </div>
            </div>

            <?php if (isset($mensagemSucesso) && $mensagemSucesso) { ?>
                <div class="alert alert-danger">
                <?php echo $mensagemSucesso; ?>
                </div>
            <?php } ?>

            <?php if (isset($mensagemErro) && $mensagemErro) { ?>
                <div class="alert alert-danger">
                <?php echo $mensagemErro; ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    
    </div>
    </div>
</div>

<?php
include '../comum/footer.php';
?>