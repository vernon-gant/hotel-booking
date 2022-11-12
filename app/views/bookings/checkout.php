<?php
require_once APPROOT . '/views/includes/header.php'
?>
	<div class="container py-5">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card border-0 shadow-lg rounded-3 text-dark">
					<div class="card-body p-5 text-center">
						<form class="mb-md-2 mt-md-4 pb-5 form" action="<?php echo URL_ROOT . "/bookings/checkout"?>" method="post">
							<div class="form-label">
								<h2 class="fw-bold mb-2 text-uppercase text-center">Check your booking details</h2>
							</div>

							<button class="submit mt-4 btn text-light btn-lg px-5 btn rounded-3 submit"
									type="submit" value="continue">Book
							</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
require_once APPROOT . '/views/includes/footer.php'
?>