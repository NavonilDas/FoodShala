<?php
	$user = $this->session->userdata( 'user' );
?>
<?php require_once 'header.php'; ?>

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

		<?php if ( count( $orders ) < 1 ) { ?>
			<div class="alert alert-info m-2" role="alert">
				No More Orders
			</div>
		<?php } ?>

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
					<div class="d-flex mt-2">
						<h6 class="card-subtitle mb-2 text-muted mt-auto" data-time="<?php echo $item->created_at; ?>"></h6>
						<?php
						if ( $item->status === 'Pending' ) {
							$front_url = base_url() . 'orders/status/' . $item->id . '/';
							?>
							<a href="<?php echo $front_url . 'Completed'; ?>" class="btn btn-success ml-auto h-fit">Complete</a>
							<a href="<?php echo $front_url . 'Rejected'; ?>" class="btn btn-danger ml-2 h-fit">Reject</a>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<div class="d-flex mr-3 fixed-bottom">
	<nav class="ml-auto">
		<ul class="pagination">
			<li class="page-item <?php echo ( $page_no <= 1 ) ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?php echo $page_no - 1; ?>">Previous</a></li>
			<li class="page-item <?php echo ( count( $orders ) < 15 ) ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?php echo $page_no + 1; ?>">Next</a></li>
		</ul>
	</nav>
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
