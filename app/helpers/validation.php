<?php

function validateLoginInput(array &$data, User $userModel): void {
	// Sanitize input
	filterPost();

	$data = [
		'email' => trim($_POST['email']),
		'pass' => sha1(trim($_POST['pass'])),
	];

	// Check email errors
	if (empty($data['email'])) {
		$data['email_err'] = 'Please, enter your email';
	}
	// Validate password
	if (empty($data['pass'])) {
		$data['pass_err'] = 'Please, enter your password';
		return;
	}

	$emailExists = $userModel->emailExists($data['email'], "User");
	$correctPassword = $userModel->correctPassword($data['email'], $data['pass'], "User");
	$isActive = $userModel->isActive($data['email']);

	if (validUser($data)) {
		if (!$emailExists) {
			$data['email_err'] = 'User with this email does not exist';
			$data['email'] = '';
		} else if (!$correctPassword) {
			$data['pass_err'] = 'Incorrect password';
			echo "<audio autoplay='true' style='display:none;'>
                <source src='" . URL_ROOT . "/audio/reminder.mp3" . "' type='audio/mpeg'>
              </audio>";
		} else if (!$isActive) {
			$data['email_err'] = ' ';
			$data['email'] = '';
			flash("user_inactive", "This user account was blocked. Please, contact administrator", class: "alert alert-danger");
		}
	}

}

function validUser(array $data): bool {
	return empty($data['email_err']) and empty($data['pass_err']);
}

function validateRegisterInput(array &$data, User $userModel): void {
	// Sanitize input
	filterPost();

	$data = [
		'first_name' => trim($_POST['first_name']),
		'last_name' => trim($_POST['last_name']),
		'email' => trim($_POST['email']),
		'pass' => trim($_POST['pass']),
		'pass_repeat' => trim($_POST['pass_repeat']),
	];

	checkEmptyRegisterFields($data);
	validateRegisterPassword($data);
	validateEmail($data);
	validateName($data);

	if ($userModel->emailExists($data['email'], "User")) {
		$data['email_err'] = 'Email is already taken';
	}

}

function validateEmail(array &$data): void {
	if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$data['email_err'] = "Invalid email";
	}
}


function validateName(array &$data): void {
	if (preg_match("@[^a-zA-Z]+@", $data['first_name'])) {
		$data['fname_err'] = "First name must contain only characters";
	}
	if (preg_match("@[^a-zA-Z]+@", $data['last_name'])) {
		$data['lname_err'] = "Last name must contain only characters";
	}
}

function validateRegisterPassword(array &$data): void {
	$containsUpperCase = preg_match('@[A-Z]+@', $data['pass']);
	$containsLowercase = preg_match('@[a-z]+@', $data['pass']);
	$containsNumber = preg_match('@[0-9]+@', $data['pass']);
	$containsSpecial = preg_match('@\W@', $data['pass']);
	if (strlen($data['pass']) < 8) {
		$data['pass_err'] = 'Password must be at least 8 characters';
	} elseif (!$containsLowercase) {
		$data['pass_err'] = 'Password must contain at least one lower case letter';
	} elseif (!$containsUpperCase) {
		$data['pass_err'] = 'Password must contain at least one upper case letter';
	} elseif (!$containsNumber) {
		$data['pass_err'] = 'Password must contain at least one number';
	} elseif (!$containsSpecial) {
		$data['pass_err'] = 'Password must contain at least one special character';
	}
	if ($data['pass'] != $data['pass_repeat']) {
		$data['pass_repeat_err'] = 'Passwords do not match';
	}
}

function checkEmptyRegisterFields(array &$data): void {

	if (empty($data['email'])) {
		$data['email_err'] = 'Please, enter your email';
	}

	if (empty($data['first_name'])) {
		$data['fname_err'] = 'Please, enter your first name';
	}

	if (empty($data['last_name'])) {
		$data['lname_err'] = 'Please, enter your last name';
	}

	if (empty($data['pass'])) {
		$data['pass_err'] = 'Please, enter your password';
	}

	if (empty($data['pass_repeat'])) {
		$data['pass_repeat_err'] = 'Please, confirm your password';
	}
}

function validRegisterOrChangeInput(array $data): bool {
	return empty($data['email_err']) and
		empty($data['fname_err']) and
		empty($data['lname_err']) and
		empty($data['pass_err']) and
		empty($data['pass_repeat_err']);
}

function validateArrivalDeparture(array &$data): void {
	$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$data['arrival'] = trim($_GET['arrival']);
	$data['departure'] = trim($_GET['departure']);

	if (isset($_SESSION['arrival']))
		unset($_SESSION['arrival'], $_SESSION['departure']);

	if (empty($data['arrival'])) {
		$data['arrival_err'] = 'Please, enter your arrival date';
	}
	if (empty($data['departure'])) {
		$data['departure_err'] = 'Please, enter your departure date your password';
	}

	$arrival = date_create($data['arrival']);
	$departure = date_create($data['departure']);

	if (date_diff($arrival, $departure)->invert == 1 || date_diff($departure, $arrival)->days == 0) {
		$data['arrival_err'] = 'Please, make sure your arrival is before your departure';
	} elseif (date_diff(date_create(), $arrival)->invert == 1 && date_diff(date_create(), $arrival)
			->days > 0) {
		$data['arrival_err'] = 'Please, make sure your arrival date is correct!';
	}
}

function validArrivalDeparture(array $data): bool {
	return empty($data['arrival_err']) and empty($data['departure_err']);
}

function validGuest(array $data): bool {
	return empty($data['fname_err']) and empty($data['lanme_err'])
		and empty($data['address_err']) and empty($data['city_err'])
		and empty($data['country_err']) and empty($data['zip_err'])
		and empty($data['dob_err']) and empty($data['phone_err']);
}

function validateGuest(array &$data): void {
	filterPost();

	$data = [
		'first_name' => trim($_POST['first_name']),
		'last_name' => trim($_POST['last_name']),
		'address' => trim($_POST['address']),
		'city' => trim($_POST['city']),
		'country' => trim($_POST['country']),
		'zip' => trim($_POST['country']),
		'dob' => trim($_POST['dob']),
		'phone' => trim($_POST['phone'])
	];

	checkEmptyGuestFields($data);
	validateName($data);
	validateGuestAddress($data);
	validateGuestDob($data);
}

function checkEmptyGuestFields(array &$data): void {

	if (empty($data['first_name'])) {
		$data['fname_err'] = 'Please, enter your first name';
	}

	if (empty($data['last_name'])) {
		$data['lname_err'] = 'Please, enter your last name';
	}

	if (empty($data['address'])) {
		$data['address_err'] = 'Please, enter your address';
	}

	if (empty($data['city'])) {
		$data['city_err'] = 'Please, enter your city';
	}

	if (empty($data['dob'])) {
		$data['dob_err'] = 'Please, enter your date of birthday';
	}

	if (empty($data['phone'])) {
		$data['phone_err'] = 'Please, enter your phone';
	}
}

function validateGuestAddress(array &$data): void {
	$addressZipRegex = '@[A-Za-z0-9\-,.]+$@';
	$cityCountryRegex = '@[a-zA-Z]+@';
	$phoneRegex = '@^\\+?[1-9][0-9]{7,14}$@';

	if (!preg_match($addressZipRegex, $data['address'])) {
		$data['address_err'] = "Invalid address format";
	}
	if (!preg_match($addressZipRegex, $data['zip'])) {
		$data['zip_err'] = "Invalid post code format";
	}

	if (!preg_match($cityCountryRegex, $data['city'])) {
		$data['city_err'] = "Invalid city format";
	}
	if (!preg_match($cityCountryRegex, $data['country'])) {
		$data['country_err'] = "Invalid country format";
	}
	if (!preg_match($phoneRegex, $data['phone'])) {
		$data['phone_err'] = "Invalid phone format";
	}
}

function validateGuestDob(array &$data): void {
	$dob = date_create($data['dob']);
	if (date_diff($dob, date_create(), true)->y > 90 ||
		date_diff($dob, date_create(), true)->y < 5)
		$data['dob_err'] = "Are you kidding?";
}

function validateAdminLogin(array &$data, User $userModel): void {
	filterPost();
	$data['email'] = trim($_POST['email']);
	$data['pass'] = empty($_POST['pass']) ? "" : sha1($_POST['pass']);
	// Check email errors
	if (empty($data['email'])) {
		$data['email_err'] = 'Please, enter your email';
	}
	// Validate password
	if (empty($data['pass'])) {
		$data['pass_err'] = 'Please, enter your password';
	}
	if (validUser($data)) {
		$emailExists = $userModel->emailExists($data['email'], "Admin");
		$correctPassword = $userModel->correctPassword($data['email'], $data['pass'], "Admin");
		if (!$emailExists) {
			$data['email_err'] = 'Admin with this email does not exist';
			$data['email'] = '';
		} else if (!$correctPassword) {
			$data['pass_err'] = 'Incorrect password for this admin';
		}
	}
}

function processPost(array &$data): void {
	filterPost();
	$data['post_title'] = trim($_POST['post_title']);
	$data['body'] = trim($_POST['body']);
	$data['image'] = $_FILES['image'] ?? null;
	if (empty($data['post_title'])) {
		$data['post_title_err'] = 'Please, enter post title';
	}
	if (empty($data['body'])) {
		$data['body_err'] = 'Please, enter post body';
	}
}

function validPost(array $data): bool {
	return empty($data['post_title_err']) and empty($data['body_err']);
}

function validChangeEmail(mixed $baseUser, User $userModel,string $email): bool {
	if ($baseUser->email == $email) return true;
	else {
		$userExists = $userModel->emailExists($email, "User");
		$adminExists = $userModel->emailExists($email, "Admin");
		return !($adminExists or $userExists);
	}
}

function validateChangeProfile(mixed $baseUser, array &$data,User $userModel) : void {
	filterPost();
	$data['email'] = empty(trim($_POST['email'])) ? null : trim($_POST['email']);
	$data['first_name'] = empty(trim($_POST['first_name'])) ? null : trim($_POST['first_name']);
	$data['last_name'] = empty(trim($_POST['last_name'])) ? null : trim($_POST['last_name']);
	$data['pass'] = empty(trim($_POST['pass'])) ? null : trim($_POST['pass']);
	$data['old_pass'] = empty(trim($_POST['old_pass'])) ? null : sha1(trim($_POST['old_pass']));
	$data['pass_repeat'] = empty(trim($_POST['pass_repeat'])) ? null : trim($_POST['pass_repeat']);

	if (!empty($data['pass'])) {
		if (empty($data['old_pass'])) $data['old_pass_err'] = "You must enter your old password to set a new one!";
		elseif ($data['old_pass'] != $baseUser->password) $data['old_pass_err'] = "Wrong password!";
		else validateRegisterPassword($data);
	}
	if (!empty($data['first_name']) or !empty($data['last_name'])) validateName($data);
	if (!validChangeEmail($baseUser,$userModel,$data['email'])) $data['email_err'] = "This user already exists! Choose other email...";
}

function prepareEditProfileData(array &$data, mixed $user) : void {
	$data = [
		'title' => 'Profile',
		'first_name' => $user->first_name,
		'last_name' => $user->last_name,
		'email' => $user->email,
		'pass' => '',
		'pass_repeat' => '',
		'old_pass' => '',
		'old_pass_err' => '',
		'fname_err' => '',
		'lname_err' => '',
		'email_err' => '',
		'pass_err' => '',
		'pass_repeat_err' => ''
	];
}

function prepareUserBookingsData(array &$data, mixed $bookings) : void {
	$data = [
		'title' => 'Bookings',
		'bookings' => $bookings
	];
}
