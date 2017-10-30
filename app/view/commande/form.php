<form id="formCommande" method="POST" action="">

		<h3>Informations</h3>

		<label for="client">Client</label>
		<select name="CL_NUMERO" id="client">
			<?php 
				foreach ($clients as $client) {
					echo '<option value="' . $client["CL_NUMERO"] . '">' . $client["CL_NOM"] . ' ' . $client["CL_PRENOM"] . '</option>';
				}
			?>
		</select><br \>

		<!-- <label for="datePicker">Date :</label>
		<input type="date" name="CO_DATE" id="datePicker"><br \> -->

		<label for="magasin">Magasin</label>
		<select id="magasin" name="MA_NUMERO">
			<?php 
				foreach ($magasins as $magasin) {
					echo '<option value="' . $magasin["MA_NUMERO"] . '">' . $magasin["MA_GERANT"] . ' (' . $magasin["MA_LOCALITE"] . ')</option>';
				}
			?>
		</select><br \><br \>

		<h3>Articles</h3>

		<div id="divArticle1">
			<label class="articleTitle" for="article">Article 1 : </label>
			<select class="article" name="article1">
				<?php 
					foreach ($articles as $article) {
						echo '<option value="' . $article["AR_NUMERO"] . '">' . $article["AR_NOM"] . ' '. $article["AR_COULEUR"] . ' (' .  $article["AR_POIDS"] . 'g, ' . $article["AR_PV"] . '€)' . '</option>';
					}
				?>
			</select>
			<label for="quantity">Qté : </label>
			<input class="quantity" name="quantity1" value="1" type="number" min="1" max="100">

			<label for="reduction">Reduction (%) : </label>
			<input class="reduction" name="reduction1" type="number" min="1" max="100">
		</div>

		<br \>
		<button id="addArticle" type="button">Ajouter un article</button><br \><br \>

	<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
</form>

<script type="text/javascript">

</script>