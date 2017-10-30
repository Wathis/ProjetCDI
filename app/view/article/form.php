<form id="formCommande" method="POST" action="">

		<label for="nom">Nom article (*):</label>
		<input type="text" name="AR_NOM" id="nom"><br \>

		<label for="pa">Prix achat (*):</label>
		<input type="number" name="AR_PA" id="pa"><br \>

		<label for="pv">Prix vente (*):</label>
		<input type="number" name="AR_PV" id="pv"><br \>

		<label for="poids">Poids (g):</label>
		<input type="number" name="AR_POIDS" id="poids"><br \>

		<label for="couleur">Couleur :</label>
		<input type="text" name="AR_COULEUR" id="couleur"><br \>

		<label for="stock">Nombre en stock :</label>
		<input type="number" name="AR_STOCK" id="stock"><br \>

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

	<input type="submit" name="submit" value="Confirmer">
</form>

<script type="text/javascript">

</script>