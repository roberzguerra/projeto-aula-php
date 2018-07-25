<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>Meu Site</title>

	<!-- Bootstrap core CSS-->
	<link href="<?php echo $SITE_URL . "/static/vendor/bootstrap/css/bootstrap.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom fonts for this template-->
	<link href="<?php echo $SITE_URL . "/static/vendor/font-awesome/css/font-awesome.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template-->
	<link href="<?php echo $SITE_URL . "/static/css/sb-admin.css" ?>" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php /* INICIO MENU PRINCIPAL */ ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Cadastro de Pessoas</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Lista de Pessoas</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php /* FIM MENU PRINCIPAL */ ?>

<?php /* INICIO CONTEUDO */ ?>
<div class="content-wrapper">
	<div class="container-fluid">

		<?php /* MIGALHAS */ ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Home</a>
			</li>
		</ol>

	<div class="card">
		<div class="card-header">
        	<i class="fa fa-user"></i> Cadastro de Estado
		</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-estado/cadastro-estado.php"; ?>" id="form-cadastro" method="POST">

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="nome">Nome</label>
							<input class="form-control" name="nome" id="nome" placeholder="Nome do estado" type="text" />
							<?php
							/* Validação do input nome (este codigo foi passado para a função exibirErro) */
							if ( isset($listaErros['nome']) && $listaErros['nome'] ) {
								?>
								<span class="text-danger"><?php echo $listaErros['nome']; ?></span>
								<?php
							}
							?>
						</div>
						<div class="col-md-6">
							<label for="sigla">Sigla</label>
							<input type="text" class="form-control" name="sigla" id="sigla" value="" placeholder="Sigla do Estado" />
							<?php echo exibirErro($listaErros, 'sigla'); ?>
						</div>
						
					</div>
				</div>
					
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
							<?php if (isset($mensagemSucesso) && $mensagemSucesso) { ?>
								<span class="text-success"><?php echo $mensagemSucesso; ?></span>
							<?php } ?>
							
							<?php
								if (isset($mensagemErro) && $mensagemErro) {
									echo '<span class="text-danger">' . $mensagemErro . '</span>';
								}
							?>
						</div>
					</div>
				</div>
				
			</form>
		</div>

	</div>
</div>
<?php /* FIM CONTEUDO */ ?>

<?php /* INICIO RODAPE */ ?>
<footer class="sticky-footer">
	<div class="container">
		<div class="text-center">
			<small>Meu Site 2018</small>
		</div>
	</div>
</footer>
<?php /* FIM RODAPE */ ?>

<?php /* SCRIPTS FINAIS */ ?>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery/jquery.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery-easing/jquery.easing.min.js"; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="<?php echo $SITE_URL . "/static/js/sb-admin.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/js/home.js"; ?> "></script>
<?php /* SCRIPTS FINAIS */ ?>
</body>
</html>