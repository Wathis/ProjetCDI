<?php 
	if (isset($success)) {
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