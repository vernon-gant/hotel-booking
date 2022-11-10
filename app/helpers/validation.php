<?php

function validateLoginInput(array &$data, Users $users): void {
	// Sanitize input
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
	}

	$emailExists = $users->getUserModel()->emailExists($data['email']);
	$correctPassword = $users->getUserModel()->correctPassword($data['email'], $data['pass']);

	if (!$emailExists) {
		$data['email_err'] = 'User with this email does not exist';
		$data['email'] = '';
	} else if (!$correctPassword) {
		$data['pass_err'] = 'Incorrect password';
		echo "<audio autoplay='true' style='display:none;'>
                <source src='" . URL_ROOT . "/audio/reminder.mp3" . "' type='audio/mpeg'>
              </audio>";
	}
}

function validUser(array $data): bool {
	return empty($data['email_err']) and empty($data['pass_err']);
}

function validateRegisterInput(array &$data, Users $users): void {
	// Sanitize input
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$data = [
		'first_name' => trim($_POST['first_name']),
		'last_name' => trim($_POST['last_name']),
		'email' => trim($_POST['email']),
		'pass' => trim($_POST['pass']),
		'pass_repeat' => trim($_POST['pass_repeat']),
	];

	checkEmptyFields($data);
	validateRegisterPassword($data);
	validateRegisterName($data);

	if ($users->getUserModel()->emailExists($data['email'])) {
		$data['email_err'] = 'Email is already taken';
	}

}

function validateRegisterName(array &$data) : void {
	if (preg_match("@[^a-zA-Z]+@",$data['first_name'])) {
		$data['fname_err'] = "First name must contain only characters";
	}
	if (preg_match("@[^a-zA-Z]+@",$data['last_name'])) {
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

function checkEmptyFields(array &$data): void {

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

function validRegisterInput(array $data): bool {
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

	if (isset($_SESSION['arrival'])) unset($_SESSION['arrival'], $_SESSION['departure']);

	if (empty($data['arrival'])) {
		$data['arrival_err'] = 'Please, enter your arrival date';
	}
	if (empty($data['departure'])) {
		$data['departure_err'] = 'Please, enter your departure date your password';
	}

	$arrival = date_create($data['arrival']);
	$departure = date_create($data['departure']);

	if (date_diff($arrival,$departure)->invert == 1 || date_diff($departure,$arrival)->days == 0) {
		$data['arrival_err'] = 'Please, make sure your arrival is before your departure';
	} elseif(date_diff(date_create(),$arrival)->invert == 1 && date_diff(date_create(),$arrival)
			->days > 0) {
		$data['arrival_err'] = 'Please, make sure your arrival date is correct!';
	}
}

function validArrivalDeparture(array $data) : bool {
	return empty($data['arrival_err']) and empty($data['departure_err']);
}
