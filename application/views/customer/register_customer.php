<?php require_once __DIR__ . '/../header.php'; ?>

<div class="container">
	<div class="col-md-6 mt-3 ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				Register Customer
			</div>

			<div class="card-body">
				<form action="<?php echo base_url() . 'register/customer'; ?>" method="post">
					<a href="<?php echo base_url() . 'register/resturant'; ?>">For Resturants Click Here</a>

					<div class="form-group">
						<label for="Name">Full Name *</label>
						<input type="text" class="form-control" name="name" id="Name" placeholder="Your Name" required>
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

					<div class="form-group" id="pref-group">
						<label for="prefer">Preference *</label>
						<select name="preference" id="prefer" class="form-control" required>
							<?php
							foreach ( $prefer as $item ) {
								echo '<option value="' . $item->id . '">' . $item->name . '</option>';
							}
							?>
						</select>
					</div>

					<button type="submit" class="btn btn-primary btn-block">Register</button>
				</form>
			</div>
		</div>
	</div>
</div>

</body>

</html>
