<div class="container">
    <h2 class="text-center">Informations du magasin</h2>

    <?php 
        require APP . 'view/_templates/alert.php';
    	if (isset($magasin)) {
    ?>
    	<div>Numero du magasin : <?php echo $magasin["MA_NUMERO"] ?></div>
    	<div>Localite du magasin : <?php echo $magasin["MA_LOCALITE"] ?></div>
    	<div>Gérant du magasin : <?php echo $magasin["MA_NOM_GERANT"] ,' ' ,$magasin["MA_PRENOM_GERANT"] ?></div>
    <?php } ?>
</div>