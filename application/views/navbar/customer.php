<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="<?php echo base_url(); ?>">FoodShala</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url(); ?>">Home</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().'orders'; ?>">My Orders</a>
			</li>

		</ul>

		<?php if ( $user === null ) { ?>
			<a class="btn btn-light my-2 my-sm-0" href="<?php echo base_url() . 'login'; ?>"><i class="fa fa-user"></i> Login</a>
			<a class="btn btn-light my-2 my-sm-0 ml-2" href="<?php echo base_url() . 'register/customer'; ?>"><i class="fa fa-user-plus"></i> Sign Up</a>
		<?php } else { ?>
			<a class="btn btn-light my-2 my-sm-0 cart" href="<?php echo base_url() . 'cart/view'; ?>">
				<i class="fa fa-shopping-cart"></i> Cart
			</a>
			
			<div class="avatar ml-2 d-flex" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="m-auto"><?php echo $user->name[0]; ?></span>

				<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left:-150px">
					<a class="dropdown-item" href="#"><?php echo $user->name; ?></a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item logout" href="<?php echo base_url() . 'login/logout'; ?>">Logout</a>
				</div>

			</div>
		
		<?php } ?>
	</div>
</nav>
