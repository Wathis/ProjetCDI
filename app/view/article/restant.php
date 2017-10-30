<div class="container">
    <h2  class="text-center">Articles de la livraison <?php echo isset($li_numero) ? $li_numero : "" ?></h2>
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
			   <th>Quantité à livrer</th>
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
		<td><?php echo $article["LIC_QTCMDEE"] - $article["LIC_QTLIVREE"]; ?></td>
		<td><div class="w3-container">
		  <div class="w3-dropdown-hover">
		    <button class="w3-button"><i class="fa fa-bars"></i></button>
		    <div class="w3-dropdown-content w3-bar-block w3-border">
		      <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Fournisseur/consulter?fo_numero=' . $article["FO_NUMERO"] . '"'; ?>>Fournisseurs</a>
		      <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'commande/consulterDepuisArticle?ar_numero=' . $article["AR_NUMERO"] . '"'; ?>>Commandes</a>
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
