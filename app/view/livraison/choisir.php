<div class="container">
	
	<h2>Choisir une commande</h2>

	<?php 
	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 
        require APP . 'view/livraison/formChoisir.php';
	?> 


	
</div>