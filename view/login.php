<?php
	$title = "Login";
	require_once '../includes/header.php'
?>
	<div class="container py-5"
	     id="content">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card border-0 shadow-lg rounded-3 text-dark">
					<div class="card-body p-5 text-center">
						<form class="mb-md-4 mt-md-4 pb-5">
							<h2 class="fw-bold mb-2 text-uppercase text-center">Login</h2>
							<p class="text-dark-50 mb-5">Please enter your login and password!</p>

							<div class="form-outline form-white form-floating mb-4">
								<input type="email"
								       id="typeEmailX"
								       class="form-control"/>
								<label class="form-label"
								       for="typeEmailX">Email</label>
							</div>

							<div class="form-outline form-white mb-5 form-floating">
								<input type="password"
								       id="typePasswordX"
								       class="form-control col-form-label-lg"/>
								<label class="form-label"
								       for="typePasswordX">Password</label>
							</div>

							<!--									<p class="small mb-5 pb-lg-2"><a href="#!">Forgot password?</a></p>-->

							<button id="login-submit"
							        class="btn text-light btn-lg px-5 btn rounded-3"
							        type="submit">Login
							</button>

							<!--									<div class="d-flex justify-content-center text-center mt-4 pt-1">-->
							<!--										<a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>-->
							<!--										<a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>-->
							<!--										<a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>-->
							<!--									</div>-->
						</form>
						<div>
							<p class="mb-0 mx-auto text-center">Don't have an account? <a id="sign-up-link"
							                                                              href="registration.php"
							                                                              class="fw-bold text-decoration-underline">Sign
							                                                                                                        Up</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once '../includes/footer.php' ?>