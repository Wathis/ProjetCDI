<div class="container">
	
	<h2>Ajouter une commande</h2>

	<?php 
	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 
        require APP . 'view/commande/form.php';
	?> 

	
</div>