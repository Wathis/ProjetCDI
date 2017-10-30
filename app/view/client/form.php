<form method="POST" action="">
		<div>
			
			

		</div>
		<label for="nom">Nom(*): :</label>
		<input id="nom" type="text" name="CL_NOM" value="<?php Form::remplirChamp($client,"CL_NOM");?>"><br \>

		<label for="prenom">Prenom(*): :</label>
		<input id="prenom" type="text" name="CL_PRENOM" value="<?php Form::remplirChamp($client,"CL_PRENOM");?>"><br \>

		<label for="ville">Ville(*): :</label>
		<input id="ville" type="text" name="CL_LOCALITE" value="<?php Form::remplirChamp($client,"CL_LOCALITE");?>"><br \>

		<label for="pays">Pays :</label>
		<select name ="CL_PAYS">
			<?php 
			foreach ($pays as $val)
			{
				$code = str_replace(' ', '', $val["CODE_ISO"]);
				echo('<option value ="' . $code . '"'); 
				if (isset($client["CL_PAYS"])) {
					if ($code == $client["CL_PAYS"]){
						echo (' selected');
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
			<?php if (isset($client["CL_TYPE"])){ $type = $client["CL_TYPE"];} else { $type='0'; } ?>
			<option <?php if ($type=='Particulier') echo ('selected'); ?> value="Particulier">Particulier</option>
			<option <?php if ($type=='Grand compte') echo ('selected'); ?> value="Grand Compte">Grand Compte</option>
			<option <?php if ($type=='PME') echo ('selected'); ?> value="PME">PME</option>
			<option <?php if ($type=='Administration') echo ('selected'); ?> value="Administration">Administration</option>
			<option  value="">Autres</option>

		</select><br />

		<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
	</form>