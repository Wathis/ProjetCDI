<div class="container">
    <h2>Page fournisseur</h2>

	<form action="<?php echo URL .'fournisseur/rechercherFournisseur' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' id="choix" onchange="tri(this)">
		<option value='Numero' selected>Numero</option>
		<option value='Nom'>Nom</option>
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
	           <th>Articles</th>
       		</tr>
   		</thead>
   <tbody>
	<?php foreach ($fournisseurs as $fournisseur) { ?>
		<tr>
			<td><?php echo $fournisseur["FO_NUMERO"]; ?></td>
			<td><?php echo $fournisseur["FO_NOM"]; ?></td>
			<td><button class="w3-button" href=<?php echo '"' . URL . 'Article/index?fo_numero=' . $fournisseur["FO_NUMERO"] . '"'; ?>><i class="fa fa-search"></i></button></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<style>
	</style>
</div>