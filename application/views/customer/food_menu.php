<?php
	$user = $this->session->userdata( 'user' );
?>
<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/customer.php'; ?>


<div class="row m-0 food-menu mb-4"></div>

	<script>
	var onProgress = false,cur = 0;
	function getData(){
		onProgress = true;
		$.get("<?php echo base_url() . 'food/menu/'; ?>"+cur, function(data, status){
			const row = $('.food-menu');
			if(cur == 0 && data.length === 0){
				row.append('<div class="alert alert-primary m-2" role="alert">No Food Items available!</div>');
			}
			if(data.length == 0) return;

			for(var item of data){
				var out = '<div class="col-md-3 mt-3 d-flex" style="min-width:251px;"><div class="card mt-auto mb-auto">';
				out += `<img class="card-img-top" src="<?php echo base_url() . 'uploads/'; ?>${item.thumbnail}" alt="${item.name}">`;
				out += `<div class="card-body"><h5 class="card-title">${item.name}</h5>`;
				out += `<h6 class="card-subtitle mb-2 text-muted">By ${item.resturant}</h6><div class="d-flex">`;
				out += `<div class="flex-grow-1"><p class="card-text">${item.price} Rs.</p></div>`;
				if(typeof item.quantity === 'undefined' || isNaN(parseInt(item.quantity))){
					out += `<a href="<?php echo base_url() . 'cart/add/'; ?>${item.id}" class="btn btn-primary m-auto"><i class="fa fa-cart-plus"></i></a>`;
				}else{
					if(+item.quantity === 1){					
						out += `<button class="btn btn-danger m-auto" onclick="deleteCart('<?php echo base_url(); ?>',${item.id})"><i class="fa fa-minus"></i></button>`;
					}else{
						out += `<button class="btn btn-danger m-auto" onclick="cartQuantity('<?php echo base_url(); ?>',${item.id},-1)"><i class="fa fa-minus"></i></button>`;
					}
					out += `<span class="m-2 mt-auto mb-auto" id="cquantity-${item.id}">${item.quantity}</span>`;
					out += `<button class="btn btn-primary m-auto" onclick="cartQuantity('<?php echo base_url(); ?>',${item.id},1)"><i class="fa fa-plus"></i></button>`;
				}
				out += 	'</div></div></div></div>';
				row.append(out);
			}
			onProgress = false;
			cur += 1;
		});

	}

	getData();

	window.addEventListener('scroll',function(event){
		if(onProgress) return;
		var scrollHeight = parseFloat(window.getComputedStyle(document.body).height.replace('px',''));
		var scrollPos = window.innerHeight + window.scrollY;
		if(((scrollHeight - 311) >= scrollPos) / scrollHeight == 0){
			onProgress = true;
			getData();
		}
	});

	</script>

	<script src="<?php echo base_url().'static/main.js'?>"></script>
</body>
</html>
