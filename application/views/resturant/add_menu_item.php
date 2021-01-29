<?php require_once __DIR__ . '/../header.php'; ?>

<?php
$food      = isset( $item ) ? $item : null;
$name      = '';
$price     = '';
$thumbnail = '';
$type      = '';

$action_url = base_url() . 'menu/add';

if ( $food !== null ) {
	$name       = $food->name;
	$price      = $food->price;
	$thumbnail  = $food->thumbnail;
	$type       = $food->type;
	$action_url = base_url() . 'menu/update/' . $food->id;
}

?>

<div class="container">
	<div class="col-md-6 mt-3 ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				<?php echo ( $food === null ) ? 'Add' : 'Update'; ?> Menu Item
			</div>
			<div class="card-body">
				<form action="<?php echo $action_url; ?>" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="Name">Name *</label>
						<input 
							type="text" 
							class="form-control" 
							name="name" 
							id="Name" 
							placeholder="Resturant Name" 
							value="<?php echo $name; ?>"
							required
						/>
					</div>

					<div class="form-group">
						<label for="price">Price (Rs.) *</label>
						<input 
							type="number" 
							class="form-control" 
							name="price" 
							id="price" 
							placeholder="100" 
							value="<?php echo $price; ?>"
							required
						>
					</div>

					<?php if ( $food !== null ) { ?>
						<label>Current Thumbnail</label>
						<div class="form-group">
							<div class="d-flex">
								<img 
									src="<?php echo base_url() . 'uploads/' . $thumbnail; ?>" 
									alt="Thumbnail" 
									style="max-width:200px;"
									class="mt-auto mb-auto"
								>
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="thumbnail"><?php echo ( $food === null ) ? '' : 'Updated'; ?> Thumbnail *</label>
						<input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
					</div>

					<div class="form-group" id="pref-group">
						<label for="prefer">Type *</label>
						<select name="preference" id="prefer" class="form-control" required>
							<?php
							foreach ( $prefer as $pre ) {
								echo '<option value="' . $pre->id . '"' . ( ( $pre->id == $type ) ? 'selected' : '' ) . ' >' . $pre->name . '</option>';
							}
							?>
						</select>
					</div>

					<button type="submit" class="btn btn-primary btn-block"><?php echo ( $food === null ) ? 'Add' : 'Update'; ?> Item</button>
				<form>
			</div>
		</div>

	</div>

</div>


</body>
</html>
