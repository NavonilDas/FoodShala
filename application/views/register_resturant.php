<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<div class="col-md-6 mt-3">
			<div class="card">
				<div class="card-header">
					Register
				</div>

				<div class="card-body">
					<form action="<?php echo base_url() . 'register'; ?>" method="post">
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

						<button type="submit" class="btn btn-primary btn-block">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		function test(ev) {
			const el = document.getElementById('pref-group');
			if(ev.target.selectedIndex === 1){
				el.style = "display:none";
			}else el.style= "display:block";
		}
	</script>
</body>

</html>
