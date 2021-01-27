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
	<a class="navbar-brand" href="<?php echo base_url(); ?>">FoodShala Cart</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
		<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
		<?php if ( $user === null ) { ?>
			<button class="btn btn-light my-2 my-sm-0 login" type="button"><i class="fa fa-user"></i> Login</button>
			<button class="btn btn-light my-2 my-sm-0 ml-2 signup" type="button"><i class="fa fa-user-plus"></i> Sign Up</button>
		<?php } else { ?>
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

<div class="row m-0">
	<div class="col-md-8 row p-3">
		<?php foreach ( $cart as $item ) { ?>

			<div class="card w-100 mt-3 ml-3" style="height: fit-content;">
				<div class="row no-gutters">
					
					<div class="col-auto mr-3">
						<img src="//placehold.it/180" class="img-fluid" alt="">
					</div>

					<div class="col">
						<div class="card-block px-2 pt-3 pb-3">
							<h4 class="card-title"><?php echo $item->name; ?></h4>
							<h6 class="card-subtitle mb-2 text-muted">Rs. <?php echo ( $item->price * $item->quantity ); ?></h6>
							
							<div class="card-text d-flex m-1">
								
								<span>Quantity <?php echo $item->quantity; ?></span>

								<a href="<?php echo base_url() . 'cart/quantity/'.$item->id.'/1' ?>" type="button" class="btn btn-primary mr-2 ml-2 <?php echo ( $item->quantity == 20 ) ? 'disabled' : ''; ?>""><i class="fa fa-plus"></i></a>
								<a href="<?php echo base_url() . 'cart/quantity/'.$item->id.'/-1' ?>" type="button" class="btn btn-primary <?php echo ( $item->quantity == 1 ) ? 'disabled' : ''; ?>"><i class="fa fa-minus"></i></a>
							</div>
		
							<div class="d-flex">
								<a href="<?php echo base_url() . 'cart/delete/' . $item->id; ?>" class="btn btn-danger ml-auto">Delete</a>
							</div>
		
						</div>
					</div>
				</div>
			</div>

		<?php } ?>

	</div>
	
	<div class="flex-grow-1"></div>
	<div class="col-md-3 p-5">
		<div class="card">
			<div class="card-body">
			<h5 class="card-title">Subtotal</h5>
			<h6 class="card-subtitle mb-2 text-muted">6 items</h6>
			<p class="card-text">1000 Rs.</p>
			<button type="button" class="btn btn-block btn-success">Checkout</button>
			</div>
		</div>
	</div>
</div>

