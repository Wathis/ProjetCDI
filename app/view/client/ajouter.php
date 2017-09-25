<div class="container">
	
	<h2>Ajouter un client</h2>

	<?php 
	if (isset($erreur)) {
		echo $erreur , "<br><br>";
	}
	?> 

	<form method="POST" action="">
		<label for="nom">Nom* :</label>
		<input type="text" name="nom" value="<?php echo isset($client['nom']) ? $client['nom'] : ''?>"><br \>

		<label for="prenom">Prenom* :</label>
		<input type="text" name="prenom" value="<?php echo isset($client['prenom']) ? $client['prenom'] : ''?>"><br \>

		<label for="localite">Ville* :</label>
		<input type="text" name="ville" value="<?php echo isset($client['ville']) ? $client['ville'] : ''?>"><br \>

		<input type="submit" name="submit" value="Ajouter">
	</form>
</div>