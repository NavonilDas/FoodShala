<?php
	$user = $this->session->userdata( 'user' );
if ( $user === null || $role !== 'Resturant' ) {
	redirect( '/' );
}
?>
<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/resturant.php'; ?>


	<h1 class="m-2">My Menu</h1>
	<div class="row food-menu m-0 pl-2"></div>

	<script>
	$.get("<?php echo base_url() . 'menu/list'; ?>", function(data, status){
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
					<a href="<?php echo base_url().'delete/';?>${item.id}" class="btn btn-danger m-auto"><i class="fa fa-trash"></i></a>
				</div>
			</div></div>`);
		}
	});
	</script>
</body>
</html>
