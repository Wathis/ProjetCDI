<div class="container">
	
	<h2>Ajouter un magasin</h2>

	<?php 

	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 
    require APP . 'view/magasin/form.php';
	?> 

</div>