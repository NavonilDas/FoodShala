<?php
	$user = $this->session->userdata( 'user' );
?>

<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/customer.php'; ?>


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
			<li class="page-item <?php echo ( $page_no <= 1 ) ? 'disabled' : ''; ?>">
				<a class="page-link" href="?page=<?php echo $page_no - 1; ?>">Previous</a>
			</li>
			
			<li class="page-item <?php echo ( count($orders) < 15 ) ? 'disabled' : ''; ?>">
				<a class="page-link" href="?page=<?php echo $page_no + 1; ?>">Next</a>
			</li>

		</ul>
	</nav>
</div>

</body>
</html>
