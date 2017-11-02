<form method="POST" action="">

	<input type="hidden" value="<?php echo $co_numero;?>" name="co_numero">

	<table id="keywords" class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
		<thead class="thead-light">
	        <tr>
	            <th>Article concerné par la livraison</th>
	            <th>Quantité livrée</th>
	        </tr>
        </thead>
        <tbody>

    	<?php
			foreach ($articles as $article) {
		?>
			<tr> 
				<td>
					<?php echo '<input name="' . $article["AR_NUMERO"] . '" type="checkbox" value="' . $article["AR_NUMERO"] . '">'?> 
					<?php echo '<label for="' . $article["AR_NUMERO"] . '">' . $article["AR_NOM"] . '</label>'?> 
				</td>
				<td>
					<input type="number" placeholder="3" name="quantity<?php echo $article['AR_NUMERO'] ?>">
				</td>
			</tr>
		<?php
			}
		?> 
		</tbody>
	</table>
	<br \>
	<input class="btn btn-success" type="submit" name="submit" value="Confirmer">
</form>
