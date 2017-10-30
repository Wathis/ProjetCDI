<form method="POST" action="">
		<label for="nom">Nom gerant :</label>
		<input id="nom" type="text" name="MA_NOM_GERANT" value="<?php Form::remplirChampSimple("MA_NOM_GERANT");?>"><br \>

		<label for="prenom">Prenom gerant :</label>
		<input id="prenom" type="text" name="MA_PRENOM_GERANT" value="<?php Form::remplirChampSimple("MA_PRENOM_GERANT");?>"><br \>

		<label for="ville">Localite :</label>
		<input id="ville" type="text" name="MA_LOCALITE" value="<?php Form::remplirChampSimple("MA_LOCALITE");?>"><br \><br \>

		<input type="submit" name="submit" value="Confirmer">
	</form>