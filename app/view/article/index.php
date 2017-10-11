<div class="container">
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
	<table id="keywords" cellspacing="0" cellpadding="0">
		<thead>
       		<tr>
	           <th>Numero</th>
	           <th>Nom</th>
	           <th>Poids</th>
	           <th>Couleur</th>
	           <th>Stock</th>
	           <th>Numero Fourniseur</th>

       		</tr>
   		</thead>
   <tbody>
	<?php foreach ($articles as $article) { ?>
		<tr>
		<td><?php echo $article["AR_NUMERO"]; ?></td>
		<td><?php echo $article["AR_NOM"]; ?></td>
		<td><?php echo $article["AR_POIDS"]; ?></td>
		<td><?php echo $article["AR_COULEUR"]; ?></td>
		<td><?php echo $article["AR_STOCK"]; ?></td>
		<td><?php echo $article["FO_NUMERO"]; ?></td>
		<td><div class="w3-container">
		  <div class="w3-dropdown-hover">
		    <button class="w3-button"><i class="fa fa-bars"></i></button>
		    <div class="w3-dropdown-content w3-bar-block w3-border">
		      <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Fourniseur/index?ar_numero=' . $article["AR_NUMERO"] . '"'; ?>>Fournisseurs</a>
		      <a href="#" class="w3-bar-item w3-button">Commandes</a>
		    </div>
		  </div>
		</div></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<style>
	</style>
</div>
