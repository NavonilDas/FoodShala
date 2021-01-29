<?php
	$user           = $this->session->userdata( 'user' );
	$no_of_items    = count( $cart );
	$amount         = 0;
	$total_quantity = 0;
	$title          = 'FoodShala Cart';
	$current_menu   = 'cart';
?>
<?php require_once __DIR__ . '/../header.php'; ?>

<?php require_once __DIR__ . '/../navbar/customer.php'; ?>

<?php if ( $checkout ) { ?>
	<div class="alert alert-success m-2" role="alert">
		Checkout Success
	</div>
<?php } ?>

<div class="row m-0">
	<div class="col-md-8 row p-3">
		<?php if ( $no_of_items === 0 ) { ?>
			<div class="alert alert-primary m-2 w-100" role="alert" style="height:fit-content;">
				Seems Your Cart is Empty!.
			</div>
			<?php
		}
		foreach ( $cart as $item ) {
				$amount         += $item->price * $item->quantity;
				$total_quantity += $item->quantity;
			?>

			<div class="card w-100 mt-3 ml-3" style="height: fit-content;">
				<div class="row no-gutters">
					
					<div class="col-auto mr-3 d-flex">
						<img src="<?php echo base_url() . 'uploads/' . $item->thumbnail; ?>" class="img-fluid mt-auto mb-auto" alt="<?php echo $item->name; ?>" style="max-width:200px">
					</div>

					<div class="col">
						<div class="card-block px-2 pt-3 pb-3">
							<h4 class="card-title"><?php echo $item->name; ?></h4>
							<h6 class="card-subtitle mb-2 text-muted">Rs. <?php echo ( $item->price * $item->quantity ); ?></h6>
							
							<div class="card-text d-flex m-1">
								
								<span>Quantity <span id="cquantity-<?php echo $item->id; ?>"><?php echo $item->quantity; ?></span></span>

								<button 
									class="btn btn-primary mr-2 ml-2" 
									onclick="cartQuantity('<?php echo base_url(); ?>',<?php echo $item->id; ?>,1,true)"
								>
									<i class="fa fa-plus"></i>
								</button>
								
								<button 
									class="btn btn-primary <?php echo ( $item->quantity == 1 ) ? 'disabled' : ''; ?>"
									onclick="cartQuantity('<?php echo base_url(); ?>',<?php echo $item->id; ?>,-1,true)"
								>
									<i class="fa fa-minus"></i>
								</button>

							</div>
		
							<div class="d-flex">
								<?php
									$delete_param = '"' . base_url() . '",' . $item->id;
								?>
								<button onclick="deleteCart('<?php echo base_url(); ?>',<?php echo $item->id; ?>)" class="btn btn-danger ml-auto">Delete</button>
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
			<h6 class="card-subtitle mb-2 text-muted"><?php echo $no_of_items; ?> items (<?php echo $total_quantity; ?> Quantity)</h6>
			<p class="card-text"><?php echo $amount; ?> Rs.</p>
			<a href="<?php echo base_url() . 'cart/checkout'; ?>" class="btn btn-block btn-success <?php echo $amount == 0 ? 'disabled' : ''; ?>">Checkout</a>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() . 'static/main.js'; ?>"></script>

</body>
</html>
