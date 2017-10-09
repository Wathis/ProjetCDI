<div class="container">
	<script src="<?php echo URL; ?>js/tri.js"></script>
    <h2>Page article</h2>

	<form action="<?php echo URL .'article/rechercherArt' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' id="choix" onchange="tri(this)">
		<option value='Numero' selected>Numero</option>
		<option value='Nom'>Nom</option>
		<option value='Poids'>Poids</option>
		<option value='Couleur'>Couleur</option>
		<option value='Stock'>Stock</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	<div id="tri" style ="display:inline">
	</div>
	</form>
	</br></br>
	<?php foreach ($articles as $article) {
		echo $article["AR_NUMERO"];
		echo "       ";
		echo $article["AR_NOM"];
		echo '</br>';
	}?>

</div>
