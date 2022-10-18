<?php
	$title = "Registration";
	require_once '../includes/header.php'
?>
	<div class="container py-5 h-100">
		<div class="row justify-content-center align-items-center h-100">
			<div class="col-10 col-md-8 col-lg-6 h-100">
				<div class="card shadow-lg p-4 p-md-5">
					<h3 class="fw-bold card-title text-center mb-4">Registration Form</h3>
					<div class="card-body container">
<!--						TODO: continue designing registration form-->
						<form action="#">
							<div>
								<div>
									<label for="Email">E-Mail</label>
									<input type="email"
									       id="Email"
									       placeholder="example@mail.com"
									       required>
									<label for="username">User name</label>
									<input type="text"
									       id="username"
									       placeholder="Username">
								</div>
								<div>
									<label for="password">Passwort</label>
									<input type="password"
									       id="password"
									       placeholder="Passwort"
									       required>
									<label for="password_repeat">Passwort</label>
									<input type="password"
									       id="password_repeat"
									       placeholder="Passwort"
									       required>
								</div>
								<div>
									<label for="address">Anrede :</label>
									<select name="address"
									        id="address">

										<option value="frau">Frau</option>
										<option value="herr">Herr</option>
										<option value="kAnrede">Keine Anrede</option>
									</select>
									<label for="Firstname">Name</label>
									<input type="text"
									       id="Firstname"
									       placeholder="Name"
									       required>
									<label for="Lastname">Nachname</label>
									<input type="text"
									       id="Lastname"
									       placeholder="Nachname"
									       required>
									<label for="tel_number">Telefonnummer</label>
									<input type="text"
									       id="tel_number"
									       placeholder="Telefonnummer">
									<div>
										<label for="adresse">Adresse</label>
										<input type="text"
										       id="adresse"
										       placeholder="Adresse">
										<label for="country">Land</label>
										<input type="text"
										       id="country"
										       placeholder="Land">
										<label for="city">Stadt</label>
										<input type="text"
										       id="city"
										       placeholder="Stadt">
										<label for="zip">PLZ</label>
										<input type="number"
										       name="zip"
										       id="zip">
									</div>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once '../includes/footer.php' ?>