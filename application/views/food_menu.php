<?php
	$user = $this->session->userdata( 'user' );
?>
<?php require_once 'header.php'; ?>

	<style>
		.avatar{
			width:40px;
			height:40px;
			border-radius:50%;
			background-color:#f6f6f6;
			position:relative;
		}
	</style>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="<?php echo base_url(); ?>">FoodShala</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>

			<?php if($role === 'Resturant'){?>
				<li class="nav-item">
					<a class="nav-link" href="#">My </a>
				</li>
			<?php }?>

		</ul>
		<form class="form-inline my-2 my-lg-0">
		<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
		<?php if ( $user === null ) { ?>
			<button class="btn btn-light my-2 my-sm-0 login" type="button"><i class="fa fa-user"></i> Login</button>
			<button class="btn btn-light my-2 my-sm-0 ml-2 signup" type="button"><i class="fa fa-user-plus"></i> Sign Up</button>
		<?php } else { ?>
			<button class="btn btn-light my-2 my-sm-0 cart" type="submit"><i class="fa fa-shopping-cart"></i> Cart</button>
			
			<div class="avatar ml-2 d-flex" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="m-auto"><?php echo $user->name[0]; ?></span>

				<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left:-150px">
					<a class="dropdown-item" href="#"><?php echo $user->name; ?></a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item logout" href="#">Logout</a>
				</div>

			</div>
		

		<?php } ?>
		</form>
	</div>
	</nav>


	<div class="row m-0 food-menu"></div>

	<script>
	$('.login').click(function() {
		window.location.href = "<?php echo base_url() . 'login'; ?>"
	});
	$('.logout').click(function() {
		window.location.href = "<?php echo base_url() . 'login/logout'; ?>"
	});
	$('.signup').click(function() {
		window.location.href = "<?php echo base_url() . 'register/customer'; ?>"
	});
	$('.cart').click(function() {
		window.location.href = "<?php echo base_url() . 'cart'; ?>"
	});
	$.get("<?php echo base_url() . 'food/menu/0'; ?>", function(data, status){
		const row = $('.food-menu');
		if(data.length === 0){
			row.append('<div class="alert alert-primary" role="alert">No Food Items available!</div>');
		}
		for(var item of data){
			row.append(`<div class="col-md-3 mt-3">
			<div class="card">
				<img class="card-img-top" src="<?php echo base_url().'uploads/'; ?>${item.thumbnail}" alt="Card image cap">
				<div class="card-body d-flex">
					<div class="flex-grow-1">
						<h5 class="card-title">${item.name}</h5>
						<p class="card-text">${item.price} Rs.</p>
					</div>
					<a href="<?php echo base_url().'delete/';?>${item.id}" class="btn btn-primary m-auto"><i class="fa fa-cart-plus"></i></a>
				</div>
			</div></div>`);
		}

	});
	</script>
</body>
</html>
