<div class="container">
	
	<h2>Clients</h2>

	<a href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>
	<form action="<?php echo URL .'client/rechercher' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix'>
		<option value='Nom' selected>Nom</option>
		<option value='prenom'>Prenom</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	</form>
	</br></br>
	<?php foreach ($clients as $client) {
		echo $client["CL_NOM"];
		echo "       ";
		echo $client["CL_PRENOM"];
		echo '</br>';
	}?>

</div>