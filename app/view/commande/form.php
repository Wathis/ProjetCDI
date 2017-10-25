<form method="POST" action="">
		<label for="nom">Numero Commande :</label>
		<input type="text" name="CO_Numero" value="<?php Form::remplirChamp($commande,"CO_Numero");?>"><br \>

		<label for="prenom">Date :</label>
		<input type="text" name="CO_Date" value="<?php Form::remplirChamp($commande,"CO_Date");?>"><br \>

		<label for="localite">Numero Client :</label>
		<input type="text" name="CL_Numero" value="<?php Form::remplirChamp($commande,"CL_Numero");?>"><br \>

		<label for="localite">Numero Magasin :</label>
		<input type="text" name="MA_Numero" value="<?php Form::remplirChamp($commande,"MA_Numero");?>"><br \>
	<input type="submit" name="submit" value="Confirmer">
</form>