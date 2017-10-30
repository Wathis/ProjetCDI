<div class="container">

	<?php 
		if (isset($fournisseur)) {
			echo '<h2>' . $fournisseur["FO_NOM"] . '</h2>'; 
		}

    	require APP . 'view/_templates/alert.php';
    
    	if (isset($fournisseur)) {
    ?>
    	<div>Numero : <?php echo $fournisseur["FO_NUMERO"] ?></div>
    	<div>Nom : <?php echo $fournisseur["FO_NOM"] ?></div>

    <?php 
		
		}

        //à faire si on a le temps
		//echo ('<a style="text-decoration:none;color:grey" href="' . URL . 'fournisseur/modifierFournisseur?FO_NUMERO=' . $fournisseur['FO_NUMERO'].'">Modifier le fournisseur</a>'); 

	?>


</div>