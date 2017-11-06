<?php 
	if (isset($success)) {
		//On ecrit dans le fichier de log
		// $log = date("Y-m-d H:i:s") . ' : ' . $success;
		// file_put_contents(UTILS ."log.data", $log.PHP_EOL , FILE_APPEND | LOCK_EX);
?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo $success ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
<?php
	}
	if (isset($errors)) {
		foreach ($errors as $error) {
			//On ecrit dans le fichier de log
			// $log = date("Y-m-d H:i:s") . ' : ' . $error;
			// file_put_contents(UTILS ."log.data", $log.PHP_EOL , FILE_APPEND | LOCK_EX);
?>			
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?php echo $error ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<?php
		}
	}
	if (isset($informations)) {
		foreach ($informations as $information) {
			//On ecrit dans le fichier de log
			// $log = date("Y-m-d H:i:s") . ' : ' . $information;
			// file_put_contents(UTILS ."log.data", $log.PHP_EOL , FILE_APPEND | LOCK_EX);
?>			
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<?php echo $information ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
<?php
		}
	}

?>