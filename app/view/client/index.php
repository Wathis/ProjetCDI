<div class="container" >
	<h2>Clients</h2>

	<a href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>
	<form action="<?php echo URL .'client/rechercherCli' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' id="choix" onchange="tri(this)">
		<option value='CL_Nom' >Nom</option>
		<option value='CL_Prenom' >Prenom</option>
		<option value='CL_Numero' selected>Numero</option>
		<option value='CL_Localite'>Localité</option>
		<option value='CL_Pays'>Pays</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	<div id="tri" style ="display:inline"></div>
	</form>
	<form action="<?php echo URL .'client/trieCli' ?>" method="post">
		<label for='tris'>Triée par :</label>
		<select name='tris' id="tris" onchange="tri(this)">
			<option value='CL_Nom' >Nom</option>
			<option value='CL_Prenom' >Prenom</option>
			<option value='CL_Numero' selected>Numero</option>
			<option value='CL_Localite'>Localité</option>
			<option value='CL_Pays'>Pays</option>
		</select>
		<div id="tris1" style ="display:inline"></div>
		<input type='submit' value='OK'></input>
	</form>
	</br></br>
	<table id="keywords" cellspacing="0" cellpadding="0">
		<thead>
       		<tr>
	           <th>Numero</th>
	           <th>Nom</th>
	           <th>Prenom</th>
	           <th>Localité</th>
	           <th>Pays</th>
	           <th>Supprimer</th>
	           <th>Modifier</th>
	           <th></th>
       		</tr>
   		</thead>
   <tbody>
	<?php foreach ($clients as $client) { ?>
		<tr>
			<td><?php echo $client["CL_NUMERO"]; ?></td>
			<td><?php echo $client["CL_NOM"]; ?></td>
			<td><?php echo $client["CL_PRENOM"]; ?></td>
			<td><?php echo $client["CL_LOCALITE"]; ?></td>
			<td><?php echo $client["CL_PAYS"]; ?></td>
			<td><?php echo ('<a class="fa fa-close" style="text-decoration:none" href="' . URL . 'client/supprimerClient?CL_NUMERO=' . $client['CL_NUMERO'].'"></a>'); ?></td>
			<td><?php echo ('<a class="fa fa-file" style="text-decoration:none;color:grey" href="' . URL . 'client/modifierClient?CL_NUMERO=' . $client['CL_NUMERO'].'"></a>'); ?></td>
			<td>
				<div class="w3-container">
	                <div class="w3-dropdown-hover">
	                    <button class="w3-button"><i class="fa fa-bars"></i></button>
	                    <div class="w3-dropdown-content w3-bar-block w3-border">
	                        <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Commande/consulterDepuisClient?CL_NUMERO=' . $client["CL_NUMERO"] . '"'; ?>>Voir commandes</a>
	                        <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Livraison/consulterLivraisonsClient?cl_numero=' . $client["CL_NUMERO"] . '"'; ?>>Voir livraisons</a>
	                    </div>
	                </div>
	            </div>
	        </td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>