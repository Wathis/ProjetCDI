<div class="container">
	
	<h2>Ajouter un fournisseur</h2>

	<?php 

	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 
    require APP . 'view/fournisseur/form.php';
	?> 

</div>