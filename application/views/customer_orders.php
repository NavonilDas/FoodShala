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
				<a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="<?php echo base_url() . '/orders'; ?>">My Orders</a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
			<?php if ( $user === null ) { ?>
			<button class="btn btn-light my-2 my-sm-0 login" type="button"><i class="fa fa-user"></i> Login</button>
			<button class="btn btn-light my-2 my-sm-0 ml-2 signup" type="button"><i class="fa fa-user-plus"></i> Sign
				Up</button>
			<?php } else { ?>
				<a href="<?php echo base_url() . '/cart/view'; ?>" class="btn btn-light my-2 my-sm-0 cart"><i class="fa fa-shopping-cart"></i> Cart</a>
				
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

<h2 class="m-3">My Orders</h2>

<?php if ( count( $orders ) < 1 ) { ?>
			<div class="alert alert-info m-2" role="alert">
				No More Orders
			</div>
<?php } ?>

<div class="row" style="margin: 0 0 60px 0;">
	<div class="col-md-6 my-orders">
		<?php
		foreach ( $orders as $item ) {
			$badge = 'primary';
			if ( $item->status === 'Completed' ) {
				$badge = 'success';
			} elseif ( $item->status === 'Rejected' ) {
				$badge = 'danger';
			}
			?>
			<div class="card m-3">
				<div class="card-block px-2 p-3">
					<h6 class="card-subtitle mb-2 text-muted">Order ID: <?php echo $item->id; ?></h6>
					<h4 class="card-title">
						<?php echo $item->name; ?>
						<span class="badge badge-<?php echo $badge; ?>"><?php echo $item->status; ?></span>
					</h4>
					<h6 class="card-subtitle mb-2 text-muted">Rs. <?php echo $item->price * $item->quantity; ?></h6>

					<div class="card-text d-flex m-1">
						<span>Quantity <?php echo $item->quantity; ?></span>
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
			<li class="page-item <?php echo ( count($orders) < 15 ) ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?php echo $page_no + 1; ?>">Next</a></li>
		</ul>
	</nav>
</div>

</body>

</html>
