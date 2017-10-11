<div class="container">
    <h2>Informations du magasin</h2>

    <?php 
    	if (isset($messages)) { 
    		foreach ($messages as $message) {
    			echo $message; 
    		}
    	}
    
    	if (isset($magasin)) {
    ?>
    	<div>Numero du magasin : <?php echo $magasin["MA_NUMERO"] ?></div>
    	<div>Localite du magasin : <?php echo $magasin["MA_LOCALITE"] ?></div>
    	<div>Gérant du magasin : <?php echo $magasin["MA_GERANT"] ?></div>

    <?php } ?>


</div>