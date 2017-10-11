<form method="POST" action="">
		<label for="nom">Nom* :</label>
		<input type="text" name="cl_nom" value="<?php Form::remplirChamp($client,"cl_nom");?>"><br \>

		<label for="prenom">Prenom* :</label>
		<input type="text" name="cl_prenom" value="<?php Form::remplirChamp($client,"cl_prenom");?>"><br \>

		<label for="localite">Ville* :</label>
		<input type="text" name="cl_localite" value="<?php Form::remplirChamp($client,"cl_localite");?>"><br \>

		<label for="pays">Pays :</label>
		<select name ="cl_pays">
			<?php foreach ($pays as $val)
			{
				echo('<option value ="'.$val["CODE_ISO"].'">'.$val["NOM"]); if ($val["CODE_ISO"] == $client["CL_PAYS"]){echo ('selected');}echo'</option>';
			}
			
			?>
		</select><br \>

		<label for="ca">Chiffre d'affaire :</label>
		<input type="text" name="cl_ca" value="<?php Form::remplirChamp($client,"CL_CA");?>"><br \>

		<label for="type">Type de client:</label>
		<select name="cl_type">
			<option selected value="Particulier">Particulier</option>
			<option  value="Grand Compte">Grand Compte</option>
			<option  value="PME">PME</option>
			<option  value="Administration">Administration</option>
			<option  value="">Autres</option>

		</select><br />

		<label for="enume">Enume :</label>
		<input type="text" name="cl_enume" value="<?php Form::remplirChamp($client,"emp_enume");?>"><br \>

		<input type="submit" name="submit" value="Confirmer">
	</form>