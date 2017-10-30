<h1 class="text-center">Erreur</h1>
<?php 

	if (isset($success)) {
		echo '<div class="alert alert-success" role="alert">' . $succes . '</div>';
	}
	if (isset($erros)) {
		foreach ($erros as $error) {
			echo '<div class="alert alert-warning" role="alert">' . $error . '</div>';
		}
	}
}?>