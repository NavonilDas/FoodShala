<?php
	$user = $this->session->userdata( 'user' );
if ( $user === null || $role !== 'Resturant' ) {
	redirect( '/' );
}
?>
<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/resturant.php'; ?>


	<h1 class="m-2">My Menu</h1>
	<div class="row food-menu m-0 pl-2 mb-2"></div>

	<script>
	var progress = false, cur_page = 0;
	function GetList() {
		if(progress) return;
		progress = true;

		$.get("<?php echo base_url() . 'menu/list/'; ?>"+cur_page, function(data, status){
			const row = $('.food-menu');
			if(data.length === 0 && cur_page === 0){
				row.append('<div class="alert alert-primary" role="alert">No Food Items available!</div>');
			}
			for(var item of data){
				row.append(`<div class="col-md-3 mt-3 d-flex"><div class="card mt-auto mb-auto">
					<img class="card-img-top" src="<?php echo base_url().'uploads/'; ?>${item.thumbnail}" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">${item.name}</h5>
						<div class="d-flex">
							<div class="flex-grow-1 mt-auto">
								<p class="card-text">${item.price} Rs.</p>
							</div>
							<a href="<?php echo base_url().'menu?id=';?>${item.id}" class="btn btn-primary m-auto"><i class="fa fa-pen"></i></a>
							<a href="<?php echo base_url().'delete/';?>${item.id}" class="btn btn-danger ml-2 mt-auto mb-auto"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div></div>`);
			}
			progress = false;
			++cur_page;
		});		
	}
	GetList();

	window.addEventListener('scroll',function(event){
		if(progress) return;
		var scrollHeight = parseFloat(window.getComputedStyle(document.body).height.replace('px',''));
		var scrollPos = window.innerHeight + window.scrollY;
		if(((scrollHeight - 311) >= scrollPos) / scrollHeight == 0){
			GetList();
		}
	});

	</script>
</body>
</html>
