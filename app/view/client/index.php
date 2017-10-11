<div class="container" >
	<script src="<?php echo URL; ?>js/tri.js"></script>
	<link href="<?php echo URL; ?>css/tableau.css" rel="stylesheet">
	<h2>Clients</h2>

	<a href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>
	<form action="<?php echo URL .'client/rechercherCli' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' id="choix" onchange="tri(this)">
		<option value='Nom' >Nom</option>
		<option value='Prenom' >Prenom</option>
		<option value='Numero' selected>Numero</option>
		<option value='Localite'>Localité</option>
		<option value='Pays'>Pays</option>
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
	           <th>Prenom</th>
	           <th>Localité</th>
	           <th>Pays</th>
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
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>