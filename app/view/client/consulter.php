<div class="container">

	<?php 
		if (isset($client)) {
			echo '<h2>' . $client["CL_NOM"] . ' ' . $client["CL_PRENOM"] . '</h2>'; 
		}
        require APP . 'view/_templates/alert.php';
        if (isset($client)){
    ?>
            <div>Numero : <?php echo $client["CL_NUMERO"] ?></div>
            <div>Nom : <?php echo $client["CL_NOM"] ?></div>
            <div>Prenom : <?php echo $client["CL_PRENOM"] ?></div>
            <div>Pays : <?php echo $client["CL_PAYS"] ?></div>
            <div>Localite : <?php echo $client["CL_LOCALITE"] ?></div>
            <div>Chiffre d'affaire : <?php echo $client["CL_CA"] ?></div>
            <div>Type : <?php echo $client["CL_TYPE"] ?></div>

        <?php 

            echo ('<br \><a class="btn btn-primary" href="' . URL . 'client/modifierClient?CL_NUMERO=' . $client['CL_NUMERO'].'">Modifier le client</a>'); 
        }

	?>


</div>