<?php 
	if (isset($success)) {
		echo '<div class="alert alert-success" role="alert">' . $success . '</div>';
	}
	if (isset($errors)) {
		foreach ($errors as $error) {
			echo '<div class="alert alert-warning" role="alert">' . $error . '</div>';
		}
	}

?>