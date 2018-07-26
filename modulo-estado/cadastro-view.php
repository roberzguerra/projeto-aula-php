<?php
include "../comum/head.php";
include "../comum/side-menu.php";
?>
<?php /* INICIO CONTEUDO */ ?>
<div class="content-wrapper">
	<div class="container-fluid">

		<?php
		include "../comum/migalhas.php";
		?>

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

<?php
include "../comum/footer.php";
?>