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

		<label for="pays">Pays :</label>
		<select name ="pays">
			<?php foreach ($pays as $val)
			{
				echo('<option value ="'.$val["CODE_ISO"].'">'.$val["NOM"].' </option>');
			}
			
			?>
		</select><br \>

		<label for="ca">Chiffre d'affaire :</label>
		<input type="text" name="ca" value="<?php Form::remplirChamp($client,"ca");?>"><br \>

		<label for="type">Type de client:</label>
		<select name="type">
			<option selected value="Particulier">Particulier</option>
			<option  value="Grand Compte">Grand Compte</option>
			<option  value="PME">PME</option>
			<option  value="Administration">Administration</option>
			<option  value="">Autres</option>

		</select><br />

		<label for="enume">Enume :</label>
		<input type="text" name="enume" value="<?php Form::remplirChamp($client,"enume");?>"><br \>

		<input type="submit" name="submit" value="Ajouter">
	</form>
</div>