<div class="container">
	
	<h2>Ajouter une commande</h2>

	<?php 

	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 

	if (isset($co_numero_ajouté)) {
		?>
		<button>
			<a class="" target="_blank" style="color:blue;text-decoration: none;" href=<?php echo '"' . URL . 'Pdf/index?co_numero=' . $co_numero_ajouté . '"'; ?>>Imprimer la commande passée en PDF</a>
		</button>
		<?php
	}

    require APP . 'view/commande/form.php';
	?> 
</div>