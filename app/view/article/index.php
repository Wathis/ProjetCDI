<div class="container">
    <h2>Page article</h2>

	<form action="<?php echo URL .'article/rechercherArt' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix'>
		<option value='Numero' selected>Numero</option>
		<option value='Nom'>Nom</option>
		<option value='Poids'>Poids</option>
		<option value='Couleur'>Couleur</option>
		<option value='Stock'>Stock</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	</form>
	</br></br>
	<?php foreach ($articles as $article) {
		echo $article["AR_NUMERO"];
		echo "       ";
		echo $article["AR_NOM"];
		echo '</br>';
	}?>

</div>
