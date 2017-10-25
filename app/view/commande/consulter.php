<div class="container">

	<?php ?>
        <h2>Liste des Commandes</h2> 
        <?php
    	if (isset($messages)) { 
    		foreach ($messages as $message) {
    			echo $message; 
    		}
    	}
    
    	if (isset($commandes)) {
            foreach($commandes as $value){
    ?>
    	<div>Numero : <?php echo $value["CO_NUMERO"] ?></div>
    	<div>Date : <?php echo $value["CO_DATE"] ?></div>
    	<div>Numero du Magasin : <?php echo $value["MA_NUMERO"] ?></div>
    	<div>Numero du client : <?php echo $value["CL_NUMERO"] ?></div>
        <br>

    <?php 
		
		}}
	?>


</div>