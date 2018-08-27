<?php
include '../comum/head.php';
?>
<style type="text/css">
@media (min-width: 992px) {
    footer.sticky-footer {
        width: 100%;
    }
}
</style>

 <div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header">Entrar</div>
    <div class="card-body">
        <form action="/login/" method="POST">
            <div class="form-group">
                <div class="form-label-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus">
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="required">
                </div>
            </div>
            <?php if (isset($mensagemErro) && $mensagemErro) { ?>
                <div class="alert alert-danger">
                <?php echo $mensagemErro; ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
        
        <a class="d-block small mt-3" href="forgot-password.html">Esqueceu sua senha?</a>
        </div>
    </div>
    </div>
</div>

<?php
include '../comum/footer.php';
?>