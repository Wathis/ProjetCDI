<form id="formCommande" method="POST" action="">

		<label for="nom">Nom article (*):</label>
		<input type="text" name="AR_NOM" id="nom" value="<?php Form::remplirChampSimple("AR_NOM");?>"><br \>

		<label for="pa">Prix achat (*):</label>
		<input type="number" name="AR_PA" id="pa" value="<?php Form::remplirChampSimple("AR_PA");?>"><br \>

		<label for="pv">Prix vente (*):</label>
		<input type="number" name="AR_PV" id="pv" value="<?php Form::remplirChampSimple("AR_PV");?>"><br \>

		<label for="poids">Poids (g):</label>
		<input type="number" name="AR_POIDS" id="poids" value="<?php Form::remplirChampSimple("AR_POIDS");?>"><br \>

		<label for="couleur">Couleur :</label>
		<input type="text" name="AR_COULEUR" id="couleur" value="<?php Form::remplirChampSimple("AR_COULEUR");?>"><br \>

		<label for="stock">Nombre en stock :</label>
		<input type="number" name="AR_STOCK" id="stock" value="<?php Form::remplirChampSimple("AR_STOCK");?>"><br \>

		<label for="fournisseur">Fournisseur :</label>
		<select id="fournisseur" name="FO_NUMERO">
			<option value="" selected>Choisir un fournisseur</option>
			<?php 
				foreach ($fournisseurs as $fournisseur) {
					echo '<option value="' . $fournisseur["FO_NUMERO"] . '">' . $fournisseur["FO_NOM"] . '</option>';
				}
			?>
		</select>

		<br \>

	<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
</form>