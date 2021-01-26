<?php require_once 'header.php'; ?>

<div class="container">
	<div class="col-md-6 mt-3 ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				Add Menu Item
			</div>
			<div class="card-body">
				<form action="<?php echo base_url() . 'addmenu/add'; ?>" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="Name">Name *</label>
						<input type="text" class="form-control" name="name" id="Name" placeholder="Resturant Name" required>
					</div>

					<div class="form-group">
						<label for="price">Price (Rs.) *</label>
						<input type="number" class="form-control" name="price" id="price" placeholder="100" required>
					</div>

					<div class="form-group">
						<label for="thumbnail">Thumbnail *</label>
						<input type="file" class="form-control-file" id="thumbnail" name="thumbnail" required>
					</div>

					<div class="form-group" id="pref-group">
						<label for="prefer">Type *</label>
						<select name="preference" id="prefer" class="form-control" required>
							<?php
							foreach ( $prefer as $item ) {
								echo '<option value="' . $item->id . '">' . $item->name . '</option>';
							}
							?>
						</select>
					</div>

					<button type="submit" class="btn btn-primary btn-block">Add Item</button>
				<form>
			</div>
		</div>

	</div>

</div>


</body>
</html>
