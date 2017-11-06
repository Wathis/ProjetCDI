<form method="POST" action="">

	<input type="hidden" value="<?php echo $co_numero;?>" name="co_numero">

	<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="date">Date prévue (*):</label>
			<input class="form-control col-sm-2" id="date" type="date" name="DATE_LIV_PREVUE"><br \>
		</div>

	<table id="keywords" class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
		<thead class="thead-light">
	        <tr>
	            <th>Article concerné par la livraison</th>
	            <th>Quantité livrée</th>
	            <th>Quantité deja Livrée</th>
	            <th>Quantité non Livrée</th>
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
				<td>
					<?php echo $article['LIC_QTLIVREE']; ?>			
				</td>
				<td>
					<?php $Qrest = $article['LIC_QTCMDEE']-$article['LIC_QTLIVREE'];echo $Qrest; ?>
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
