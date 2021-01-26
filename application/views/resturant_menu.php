<?php
	$user = $this->session->userdata( 'user' );
if ( $user === null || $role !== 'Resturant' ) {
	redirect( '/' );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FoodShala</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
	</head>
<body>
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
				<a class="nav-link" href="#">My Menu <span class="sr-only">(current)</span></a>
			</li>

		</ul>
		<form class="form-inline my-2 my-lg-0">

			<button class="btn btn-light my-2 my-sm-0 addItem" type="button"><i class="fa fa-shopping-cart"></i> Add Item</button>
			
			<div class="avatar ml-2 d-flex" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="m-auto"><?php echo $user->name[0]; ?></span>

				<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left:-150px">
					<a class="dropdown-item" href="#"><?php echo $user->name; ?></a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item logout" href="#">Logout</a>
				</div>

			</div>
		

		</form>
	</div>
	</nav>

	<h1 class="m-2">My Menu</h1>
	<div class="row menu m-0">
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top" src="<?php echo base_url().'uploads/'; ?>2b98867d259530411b7cb63b008e4984.JPG" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					<a href="#" class="btn btn-primary">Go somewhere</a>
				</div>
			</div>
		</div>
	</div>

	<script>
	$('.addItem').click(function() {
		window.location.href = "<?php echo base_url() . 'addmenu'; ?>";
	});
	$('.logout').click(function() {
		window.location.href = "<?php echo base_url() . 'login/logout'; ?>"
	});
	$.get("<?php echo base_url() . 'addmenu/list'; ?>", function(data, status){
		// alert("Data: " + data + "\nStatus: " + status);
		console.log(data);
	});
	</script>
</body>
</html>
