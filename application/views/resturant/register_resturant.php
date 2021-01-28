<?php require_once __DIR__ . '/../header.php'; ?>


<div class="container">
	<div class="col-md-6 mt-3 ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				Register Resturant
			</div>

			<div class="card-body">
				<form action="<?php echo base_url() . 'register/resturant'; ?>" method="post">

					<div class="form-group">
						<label for="Name">Name *</label>
						<input type="text" class="form-control" name="name" id="Name" placeholder="Resturant Name" required>
						<div class="invalid-feedback">
							<?php echo strip_tags( form_error( 'name' ) ); ?>
						</div>
					</div>

					<div class="form-group">
						<label for="Email">Email *</label>
						<input type="email" class="form-control" name="email" id="Email" placeholder="user@host.com" required>
						<div class="invalid-feedback">
							<?php echo strip_tags( form_error( 'email' ) ); ?>
						</div>
					</div>

					<div class="form-group">
						<label for="Phone">Phone Number *</label>
						<input type="tel" name="phone" class="form-control" id="Phone" pattern="[1-9]{1}[0-9]{9}" required>
						<div class="invalid-feedback">
							<?php echo strip_tags( form_error( 'email' ) ); ?>
						</div>
					</div>

					<div class="form-group">
						<label for="password">Password *</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="" required>
						<div class="invalid-feedback">
							<?php echo strip_tags( form_error( 'password' ) ); ?>
						</div>
					</div>

					<div class="form-group">
						<label for="address">Address *</label>
						<textarea name="address" class="form-control" id="address" placeholder="" required></textarea>
					</div>


					<button type="submit" class="btn btn-primary btn-block">Register</button>
				</form>
			</div>
		</div>
	</div>
</div>

</body>

</html>
