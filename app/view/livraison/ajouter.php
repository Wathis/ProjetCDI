<div class="container">
	
	<h2>Ajouter une livraison à la commande <?php echo $co_numero ?></h2>

	<?php 
	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
		if (count($articles) == 0) {
			echo "Aucun article dans la commande";
		}
	} 
        require APP . 'view/livraison/form.php';
	?> 


	
</div>