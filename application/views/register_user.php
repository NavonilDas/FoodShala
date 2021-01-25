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
							<input type="text" class="form-control" name="name" id="Name" placeholder="Your Name">
						</div>

						<div class="form-group">
							<label for="Email">Email *</label>
							<input type="email" class="form-control" name="email" id="Email" placeholder="user@host.com">
						</div>

						<div class="form-group">
							<label for="Phone">Phone Number *</label>
							<input type="tel" name="phone" class="form-control" id="Phone">
						</div>

						<div class="form-group">
							<label for="password">Password *</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="">
						</div>

						<div class="form-group">
							<label for="userType">User Type *</label>
							<select id="userType" name="user_type" class="form-control">
								<option selected>Customer</option>
								<option>Resturant</option>
							</select>
						</div>

						<div class="form-group">
							<label for="prefer">Prefernce *</label>
							<select name="preference" id="prefer" class="form-control">
								<option selected>Choose...</option>
								<option>Veg</option>
								<option>Non Veg</option>
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
