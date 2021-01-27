<?php
	$user = $this->session->userdata( 'user' );
?>
<?php require_once 'header.php'; ?>

<style>
	.avatar {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		background-color: #f6f6f6;
		position: relative;
	}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="<?php echo base_url(); ?>">FoodShala</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>">My Menu</a>
			</li>

			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url() . 'orders'; ?>">View Orders <span class="sr-only">(current)</span></a>
			</li>

		</ul>
		<form class="form-inline my-2 my-lg-0">
			<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
			<?php if ( $user === null ) { ?>
			<button class="btn btn-light my-2 my-sm-0 login" type="button"><i class="fa fa-user"></i> Login</button>
			<button class="btn btn-light my-2 my-sm-0 ml-2 signup" type="button"><i class="fa fa-user-plus"></i> Sign
				Up</button>
			<?php } else { ?>
				
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
						<a class="dropdown-item logout" href="#">Logout</a>
					</div>

				</div>

			<?php } ?>
		</form>
	</div>
</nav>

<h2 class="m-3">Orders</h2>

<ul class="nav nav-tabs ml-2">
  <li class="nav-item">
	<a class="nav-link <?php echo ( $status === 'Pending' ) ? 'active' : ''; ?>" href="?status=Pending">Pending</a>
  </li>
  <li class="nav-item">
	<a class="nav-link <?php echo ( $status === 'Completed' ) ? 'active' : ''; ?>" href="?status=Completed">Completed</a>
  </li>
  <li class="nav-item">
	<a class="nav-link <?php echo ( $status === 'Rejected' ) ? 'active' : ''; ?>" href="?status=Rejected">Rejected</a>
  </li>
</ul>

<div class="row" style="margin: 0 0 60px 0;">
	<div class="col-md-6 my-orders">
		<?php
		foreach ( $orders as $item ) {
			?>
			<div class="card m-3">
				<div class="card-block px-2 p-3">
					<h6 class="card-subtitle mb-2 text-muted">Order ID: <?php echo $item->id; ?></h6>
					<h4 class="card-title">
						<?php echo $item->name; ?>
					</h4>

					<h6 class="card-subtitle mb-2 text-muted">Rs. <?php echo $item->price * $item->quantity; ?></h6>

					<span>Quantity <?php echo $item->quantity; ?></span>
					<div class="d-flex">
						<h6 class="card-subtitle mb-2 text-muted mt-auto" data-time="<?php echo $item->created_at; ?>"></h6>
						<?php if ( $item->status === 'Pending' ) { ?>
							<a href="<?php echo base_url() . 'cart/delete/' . $item->id; ?>" class="btn btn-success ml-auto">Complete</a>
							<a href="<?php echo base_url() . 'cart/delete/' . $item->id; ?>" class="btn btn-danger ml-2">Reject</a>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
		$('[data-time]').each(function(i,el) {
			var mome = moment(el.getAttribute('data-time')).fromNow();
			el.innerText = mome;
		});
</script>
</body>

</html>
