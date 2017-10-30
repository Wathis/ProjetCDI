<form method="POST" action="">

	<label for="commande">Commande : </label>
		<select name="CO_NUMERO" id="commande">
			<option value="">Choisir une commande</option>
			<?php 
				foreach ($commandes as $commande) {
					echo '<option value="' . $commande["CO_NUMERO"] . '">'  . $commande["CO_NUMERO"] . ' | ' . $commande["CL_NOM"] . ' ' . $commande["CL_PRENOM"] . ' | ' . $commande["CO_DATE"] . '</option>';
				}
			?>
		</select><br \>
	<br \>
	<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
</form>
