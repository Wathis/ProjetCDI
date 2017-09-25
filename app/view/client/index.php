<div class="container">
	
	<h2>Clients</h2>

	<a href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>

	<?php foreach ($clients as $client) {
		echo $client["CL_NOM"] . '<br \>';
	}?>

</div>