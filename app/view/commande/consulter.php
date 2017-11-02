<div class="container">

	<?php ?>
        <h2 class="text-center">Liste des Commandes</h2> 
        <?php
    	require APP . 'view/_templates/alert.php';
    

    	if (isset($commandes)) {

            if (count($commandes) == 0){
                echo '<div class="alert alert-warning">Pas de commandes</div>';
            }
 
            foreach($commandes as $value){
    ?>
    	<div>Numero : <?php echo $value["CO_NUMERO"] ?></div>
    	<div>Date : <?php echo $value["CO_DATE"] ?></div>
    	<div>Numero du Magasin : <?php echo $value["MA_NUMERO"] ?></div>
    	<div>Numero du client : <?php echo $value["CL_NUMERO"] ?></div>
        <div>Detail client : <?php echo $value["CL_NOM"] , ' ', $value["CL_PRENOM"] ?></div>
        <br>

    <?php 
		
		}}
	?>


</div>