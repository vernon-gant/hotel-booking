<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
	<div class="container px-3">
		<div class="row my-4">
			<div class="mx-auto">
				<ul class="list-unstyled container row mb-0 mx-0">
					<li class="d-flex flex-column">
						<i class="fas fa-map-marker-alt fa-2x"></i>
						<p class="text-center text-wrap mt-2">Wien, Höchstädtplatz 6, Österreich</p>
					</li>

					<li class="d-flex flex-column">
						<i class="fas fa-phone fa-2x"></i>
						<p class="text-center text-wrap mt-2">+ 01 234 567 89</p>
					</li>
					<li class="d-flex flex-column">
						<i class="fas fa-envelope fa-2x"></i>
						<p class="text-center text-wrap mt-2">info@motelx.co</p>
					</li>
				</ul>
			</div>
		</div>
		<div class="row mb-5">
			<div class="card border-0 shadow-lg col-10 col-md-8 col-lg-6
				mx-auto p-4">
				<h3 class="fw-bold card-title text-center mb-4">Contact us</h3>
				<div class="card-body container">
					<form action="#"
					      class="col-12 w-100"
					      id="contact-form"
					      method="POST"
					      name="contact-form">
						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-12 col-md-7 mb-4 form-floating form-outline">
								<input required
								       class="form-control"
								       id="name"
								       name="name"
								       type="text">
								<label class="form-label mx-2"
								       for="name">Name</label>
							</div>
							<!--Grid column-->
							<div class="col-12 col-md-5 mb-4 form-floating form-outline">
								<input required
								       class="form-control"
								       id="phone"
								       name="email"
								       type="tel">
								<label class="form-label mx-2"
								       for="phone">Phone</label>
							</div>
						</div>
						<!--Grid row-->

						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-12 col-md-8 mb-4 form-floating form-outline">
								<input required
								       class="form-control"
								       id="email"
								       name="email"
								       type="email">
								<label class="form-label mx-2"
								       for="email">Email</label>
							</div>
							<!--Grid column-->
							<div class="col-5 col-md-4 mb-4 mx-auto">
								<div class="input-group h-100 row m-0">
									<label class="input-group-text col-auto fw-bold w-100 h-50 p-0 justify-content-center guests-label"
									       for="guests">Guests
									</label>
									<select class="form-select col-auto w-100 rounded-2 h-50 p-0"
									        id="guests"
									        required>
										<option class="text-center"
										        selected
										        value="1">1
										</option>
										<option class="text-center"
										        value="2">2
										</option>
										<option class="text-center"
										        value="3">3
										</option>
										<option class="text-center"
										        value="4">4
										</option>
									</select>
								</div>
							</div>

						</div>
						<!--Grid row-->

						<!--Grid row-->
						<div class="row">
							<!--Grid column-->
							<div class="col-12 col-md-5 mb-4 form-floating form-outline">
								<input required
								       class="form-control"
								       id="arrival"
								       name="arrival"
								       type="date">
								<label class="form-label mx-2"
								       for="arrival">Arrival</label>
							</div>
							<div class="col-12 col-md-2 mb-4 d-flex justify-content-center align-items-center">
								<i id="arr-dep-arrow"
								   class="fa-solid fa-arrow-right fa-lg"></i>
							</div>
							<div class="col-12 col-md-5 mb-4 form-floating form-outline">
								<input required
								       class="form-control"
								       id="departure"
								       name="departure"
								       type="date">
								<label class="form-label mx-2"
								       for="departure">Departure</label>
							</div>
						</div>
						<!--Grid row-->

						<div class="row">
							<!--Grid column-->
							<div class="col-12 mb-4 form-floating form-outline">
									<textarea class="form-control w-100 h-auto pt-5 px-3"
									          id="comment"
									          name="comment"
									          rows="10"
									          maxlength="500">
									</textarea>
								<label class="form-label mx-2 fs-5"
								       for="comment">Comment</label>
							</div>
						</div>
						<div class="row my-4">
							<button id="submit-contact"
							        type="submit"
                                    name="submit"
							        class="btn rounded-pill w-50 mx-auto">Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>