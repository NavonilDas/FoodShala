<?php require_once 'header.php'; ?>
<div class="container d-flex" style="height:100vh">
		<div class="col-md-6 m-auto">
			<div class="card">
				<div class="card-header">
					User Login
				</div>
				<div class="card-body">
					<form action="<?php echo base_url() . 'login'; ?>" method="post">

						<div class="form-group">
							
							<div class="invalid-feedback d-block">
								<?php echo isset( $error ) ? $error : ''; ?>
							</div>

							<label for="email">Email *</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="name@host.com" required>
						</div>

						<div class="form-group">
							<label for="password">Password *</label>
							<input type="password" class="form-control" name="password" id="password" required>
						</div>


						<button type="submit" class="btn btn-primary btn-block">Login</button>
					</form>
				</div>

			</div>
		</div>
</div>

</body>
</html>
