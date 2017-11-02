<div class="container">
	<?php 
		require APP . 'view/_templates/alert.php';
	?>
	<br \>

	<a href="<?php echo URL ?>parametre/insertArticle" class="btn btn-success">Generer articles</a><br \><br \>

	<a href="<?php echo URL ?>parametre/insertMagasin" class="btn btn-success">Generer magasins</a><br \><br \>

	<a href="<?php echo URL ?>parametre/insertFournisseur" class="btn btn-success">Generer fournisseurs</a><br \><br \>

	<a href="<?php echo URL ?>parametre/resetCommande" class="btn btn-warning">Reset Commande Livraison</a><br \><br \>

	<a href="<?php echo URL ?>parametre/resetAll" class="btn btn-danger">Reset toute la base</a>


	<a href="<?php echo URL ?>parametre/recreerLaBaseDeDonnee" class="btn btn-danger">Recreer la base de données</a>

</div>