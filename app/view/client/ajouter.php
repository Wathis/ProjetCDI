<div class="container">
	
	<h2>Ajouter un client</h2>

	<?php 
	if (isset($erreur)) {
		echo $erreur , "<br><br>";
	}
	?> 

	<form method="POST" action="">
		<label for="nom">Nom* :</label>
		<input type="text" name="nom" value="<?php Form::remplirChamp($client,"nom");?>"><br \>

		<label for="prenom">Prenom* :</label>
		<input type="text" name="prenom" value="<?php Form::remplirChamp($client,"prenom");?>"><br \>

		<label for="localite">Ville* :</label>
		<input type="text" name="ville" value="<?php Form::remplirChamp($client,"ville");?>"><br \>

		<label for="pays">Pays* :</label>
		<select name ="pays">
			<option value =""

		</select>

		<label for="ville">Ville:</label>
		<input type="text" name="ville" value="<?php Form::remplirChamp($client,"prenom");?>"><br \>

		<label for="ca">Chiffre d'affaire :</label>
		<input type="text" name="ca" value="<?php Form::remplirChamp($client,"prenom");?>"><br \>

		<label for="type">Type:</label>
		<input type="text" name="type" value="<?php Form::remplirChamp($client,"prenom");?>"><br \>

		<label for="enume">Enume* :</label>
		<input type="text" name="enume" value="<?php Form::remplirChamp($client,"prenom");?>"><br \>

		<input type="submit" name="submit" value="Ajouter">
	</form>
</div>