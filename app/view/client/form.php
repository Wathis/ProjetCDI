<form method="POST" action="">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="nom">Nom(*): :</label>
			<input class="form-control col-sm-2" id="nom" type="text" name="CL_NOM" value="<?php Form::remplirChamp($client,"CL_NOM");?>"><br \>
		</div>


		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="prenom">Prenom (*):</label>
			<input class="form-control col-sm-2" id="prenom" type="text" name="CL_PRENOM" value="<?php Form::remplirChamp($client,"CL_PRENOM");?>"><br \>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="ville">Ville(*): :</label>
			<input class="form-control col-sm-2" id="ville" type="text" name="CL_LOCALITE" value="<?php Form::remplirChamp($client,"CL_LOCALITE");?>"><br \>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="pays">Pays :</label>
			<select class="form-control col-sm-2" name ="CL_PAYS">
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
			</select>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="ca">Chiffre d'affaire :</label>
			<input class="form-control col-sm-2" type="text" name="CL_CA" value="<?php Form::remplirChamp($client,"CL_CA");?>">
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="type">Type de client:</label>
			<select class="form-control col-sm-2" name="CL_TYPE">
				<?php if (isset($client["CL_TYPE"])){ $type = $client["CL_TYPE"];} else { $type='0'; } ?>
				<option <?php if ($type=='Particulier') echo ('selected'); ?> value="Particulier">Particulier</option>
				<option <?php if ($type=='Grand compte') echo ('selected'); ?> value="Grand Compte">Grand Compte</option>
				<option <?php if ($type=='PME') echo ('selected'); ?> value="PME">PME</option>
				<option <?php if ($type=='Administration') echo ('selected'); ?> value="Administration">Administration</option>
				<option  value="">Autres</option>

			</select><br />
		</div>

		<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
	</form>