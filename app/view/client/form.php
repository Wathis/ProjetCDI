<form method="POST" action="">
		<label for="nom">Nom* :</label>
		<input type="text" name="CL_NOM" value="<?php Form::remplirChamp($client,"CL_NOM");?>"><br \>

		<label for="prenom">Prenom* :</label>
		<input type="text" name="CL_PRENOM" value="<?php Form::remplirChamp($client,"CL_PRENOM");?>"><br \>

		<label for="localite">Ville* :</label>
		<input type="text" name="CL_LOCALITE" value="<?php Form::remplirChamp($client,"CL_LOCALITE");?>"><br \>

		<label for="pays">Pays :</label>

		<select name ="CL_PAYS">
			<?php 
			foreach ($pays as $val)
			{
				echo('<option value ="'.$val["CODE_ISO"].'" '); 
				if (isset($client["CL_PAYS"])) {
					if ($val["CODE_ISO"] == $client["CL_PAYS"]){
						echo ('selected');
					}
				}
				echo ('>' . $val["NOM"]);
				echo'</option>';
			}
		
			?>	
		</select><br \>

		<label for="ca">Chiffre d'affaire :</label>
		<input type="text" name="CL_CA" value="<?php Form::remplirChamp($client,"CL_CA");?>"><br \>

		<label for="type">Type de client:</label>
		<select name="CL_TYPE">
			<option selected value="Particulier">Particulier</option>
			<option  value="Grand Compte">Grand Compte</option>
			<option  value="PME">PME</option>
			<option  value="Administration">Administration</option>
			<option  value="">Autres</option>

		</select><br />

		<label for="enume">Enume :</label>
		<input type="text" name="EMP_ENUME" value="<?php Form::remplirChamp($client,"EMP_ENUME");?>"><br \>

		<input type="submit" name="submit" value="Confirmer">
	</form>