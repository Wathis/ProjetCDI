<div class="container">
	
	<h2 class="text-center">Ajouter une livraison à la commande <?php echo $co_numero ?></h2>

	<?php 
	require APP . 'view/_templates/alert.php';
	if (count($articles) == 0) {
		echo '<div class="alert alert-secondary">Aucun article dans la commande</div>';
	}
	
        require APP . 'view/livraison/form.php';
	?> 


	
</div>