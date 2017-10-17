<h1>Erreur</h1>
<?php 

if (isset($messages))  {
	foreach ($messages as $message) {
		echo $message . "<br />";
	}
}?>