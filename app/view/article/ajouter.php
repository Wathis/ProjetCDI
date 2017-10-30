<div class="container">
	
	<h2>Ajouter un article</h2>

	<?php 

	if (isset($messages)) {
	    foreach ($messages as $message) {
            echo $message , "<br>";
        }
        echo '<br>';
	} 
    require APP . 'view/article/form.php';
	?> 

</div>