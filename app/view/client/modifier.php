<div class="container">
	
	<h2>Modifier un client</h2>

	<?php 
	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	}

	require APP . 'view/client/form.php';
	
	?> 

</div>