<div class="container">
	
	<h2>Modifier un client : <?php Form::remplirChamp($client,"CL_NUMERO"); ?></h2>

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