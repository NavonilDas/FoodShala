<?php
	$current_menu = isset( $current_menu ) ? $current_menu : 'home';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="<?php echo base_url(); ?>">FoodShala</a>

	<button 
		class="navbar-toggler" 
		type="button" 
		data-toggle="collapse" 
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" 
		aria-expanded="false" 
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ( $current_menu === 'home' ) ? 'active' : ''; ?>">
				<a class="nav-link" href="<?php echo base_url(); ?>">My Menu</a>
			</li>

			<li class="nav-item <?php echo ( $current_menu === 'orders' ) ? 'active' : ''; ?>">
				<a class="nav-link" href="<?php echo base_url() . 'orders'; ?>">View Orders</a>
			</li>

		</ul>			
			<div class="avatar ml-2 d-flex" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
				<span class="m-auto">
					<?php echo $user->name[0]; ?>
				</span>

				<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left:-150px">
					<a class="dropdown-item" href="#">
						<?php echo $user->name; ?>
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item logout" href="<?php echo base_url() . 'login/logout'; ?>">Logout</a>
				</div>

			</div>
	</div>
</nav>
