<div class="container" >
	<script src="<?php echo URL; ?>js/tri.js"></script>
	<h2>Clients</h2>

	<a href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>
	<form action="<?php echo URL .'client/rechercherCli' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' onchange="tri()">
		<option value='Nom' ">Nom</option>
		<option value='prenom' >Prenom</option>
		<option value='Numero' >Numero</option>
		<option value='Localite'>Localité</option>
		<option value='Pays'>Pays</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	<div id="tri">
	</div>
	</form>
	</br></br>

	<?php foreach ($clients as $client) {
		echo $client["CL_NOM"];
		echo "       ";
		echo $client["CL_PRENOM"];
		echo '</br>';
	}?>

</div>