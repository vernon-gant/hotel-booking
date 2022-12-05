<?php

class UserService extends Service {

	private User $userModel;

	public function __construct() {
		$this->userModel = $this->model('User');
	}

	public function login(): array {
		$data = [
			'title' => 'Login',
			'email' => '',
			'pass' => '',
			'email_err' => '',
			'pass_err' => '',
		];
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['arrival'])) {
			$_SESSION['bookingRedirect'] = true;
		}
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateLoginInput($data,$this->userModel);
			// Check if empty errors
			if (validUser($data)) {
				$user = $this->userModel->findUser($data['email']);
				$this->userModel->createSession($user,"user");
				if (isset($_SESSION['bookingRedirect'])) {
					unset($_SESSION['bookingRedirect']);
					redirect("bookings/index");
				} else {
					redirect("pages/index");
				}
			}
		}
		return $data;
	}

	public function registration() : array {
		$data = [
			'title' => 'Register',
			'first_name' => '',
			'last_name' => '',
			'email' => '',
			'pass' => '',
			'pass_repeat' => '',
			'fname_err' => '',
			'lname_err' => '',
			'email_err' => '',
			'pass_err' => '',
			'pass_repeat_err' => ''
		];
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateRegisterInput($data,$this->userModel);
			// Make sure errors are empty
			if (validRegisterOrChangeInput($data)) {
				$data['pass'] = sha1($data['pass']);
				switch ($this->userModel->register($data)) {
					case true:
						flash("register_success","You are registered and can log in");
						redirect("users/login");
						break;
					case false:
						die("Something went wrong...");
				}
			}
		}
		return $data;
	}

	public function profile() : array {
		$data = array();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$baseUser = $this->userModel->findUser($_SESSION['user_email']);
			prepareEditProfileData($data,$baseUser);
			validateChangeProfile($baseUser,$data,$this->userModel);
			if (validRegisterOrChangeInput($data) and empty($data['old_pass_err'])) {
				$formData = userFormData();
				$success = $this->userModel->changeUser($baseUser,$formData);
				if ($success) {
					flash("user_change_success","Your profile was successfully changed!");
					$newUser = $this->userModel->findUser($formData['email']);
					$this->userModel->createSession($newUser,"user");
				}
				else die("Something went wrong...");
			}
		}
		$baseUser = $this->userModel->findUser($_SESSION['user_email']);
		prepareEditProfileData($data,$baseUser);
		return $data;
	}

	public function bookings() : array {
		$data = array();
		$bookings = $this->userModel->fetchBookings();
		prepareUserBookingsData($data,$bookings);
		return $data;
	}

	public function logout() : void {
		$this->userModel->logout("user");
	}
}