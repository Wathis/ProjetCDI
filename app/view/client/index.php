<div class="container" >
	<h2 class="text-center">Clients</h2>

	<?php

		require APP . 'view/_templates/alert.php';

	?> 

	<a class="btn btn-secondary btn-sm" href="<?php echo URL . 'client/ajouter' ?>">Ajouter un client</a><br \><br \>
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
	<input class="btn btn-info btn-sm" type='submit' value='Recherche'></input>
	<div id="tri" style ="display:inline"></div>

	</form>
	<!-- <form action="<?php echo URL .'client/trieCli' ?>" method="post">
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
	</form> -->
	</br>

	<?php  
        foreach ($clients as $client) {
            if (in_array($client["CL_NUMERO"],$clientAvecRetard)){
                echo '<div style="color:red">Des clients ont des commandes en retard</div>';
                break;
            }
        }
    ?>

	</br>
	<table id="keywords" class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
		<thead class="thead-light">
       		<tr>
	           <th scope="col">Numero</th>
	           <th scope="col">Nom</th>
	           <th scope="col">Prenom</th>
	           <th scope="col">Localité</th>
	           <th scope="col">Pays</th>
	           <th scope="col">Supprimer</th>
	           <th scope="col">Modifier</th>
	           <th scope="col"></th>
       		</tr>
   		</thead>
   <tbody>
	<?php foreach ($clients as $client) { ?>
		<tr>
			<td>
                    <?php 
                        //Alors c'est un retard
                        if (in_array($client["CL_NUMERO"],$clientAvecRetard)) {
                            echo '<span style="color:red">' . $client["CL_NUMERO"] . '</span>';
                        } else {
                            echo $client["CL_NUMERO"]; 
                        }   
                    ?>
                </td>
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