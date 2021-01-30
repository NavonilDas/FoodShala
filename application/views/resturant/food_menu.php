<?php
	$user = $this->session->userdata( 'user' );
	$current_menu = 'all_menu';
?>
<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/resturant.php'; ?>

<?php if ( count( $items ) <= 0 ) { ?>
	<div class="alert alert-primary m-2" role="alert">No Food Items available!</div>
<?php } ?>

<div class="row" style="margin:0 0 60px 0;">
	<?php foreach ($items as $item) { ?>
		<div class="col-md-3 mt-3 d-flex" style="min-width:251px;"><div class="card mt-auto mb-auto">
				<img class="card-img-top" src="<?php echo base_url() . 'uploads/'.$item->thumbnail; ?>" alt="<?php echo $item->name; ?>">
				<div class="card-body">
					<h5 class="card-title"><?php echo $item->name; ?></h5>
					<h6 class="card-subtitle mb-2 text-muted">By <?php echo $item->resturant; ?></h6>
					<p class="card-text"><?php echo $item->price; ?> Rs.</p>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<div class="d-flex mr-3 fixed-bottom">
	<nav class="ml-auto">
		<ul class="pagination">
			<li class="page-item <?php echo ( $page_no <= 1 ) ? 'disabled' : ''; ?>">
				<a class="page-link" href="?page=<?php echo $page_no - 1; ?>">Previous</a>
			</li>
			
			<li class="page-item <?php echo ( count($items) < 12 ) ? 'disabled' : ''; ?>">
				<a class="page-link" href="?page=<?php echo $page_no + 1; ?>">Next</a>
			</li>

		</ul>
	</nav>
</div>


</body>
</html>
