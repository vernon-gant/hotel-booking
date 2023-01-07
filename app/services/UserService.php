<?php

/**
 *
 */
class UserService extends Service {

	private User $userModel;

	public function __construct() {
		$this->userModel = $this->model('User');
	}

	/**
	 * @return string[]
	 */
	public function login(): array {
		$data = [
			'title' => 'Login',
			'email' => isset($_POST['email']) ? trim($_POST['email']) : "",
			'pass' => isset($_POST['pass']) ? sha1(trim($_POST['pass'])) : "",
		];
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['arrival'])) {
			$_SESSION['bookingRedirect'] = true;
		}
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateLoginInput($data, $this->userModel);
			// Check if empty errors
			if (validUser($data)) {
				$user = $this->userModel->findUser($data['email']);
				$this->userModel->createSession($user, "user");
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

	/**
	 * @return string[]
	 */
	public function registration(): array {
		$data = [
			'title' => 'Register',
			'first_name' => isset($_POST['first_name']) ? trim($_POST['first_name']) : "",
			'last_name' => isset($_POST['last_name']) ? trim($_POST['last_name']) : "",
			'email' => isset($_POST['email']) ? trim($_POST['email']) : "",
			'pass' => isset($_POST['pass']) ? trim($_POST['pass']) : "",
			'pass_repeat' => isset($_POST['pass_repeat']) ? trim($_POST['pass_repeat']) : "",
		];
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateRegisterInput($data, $this->userModel);
			// Make sure errors are empty
			if (validRegisterOrChangeInput($data)) {
				$data['pass'] = sha1($data['pass']);
				switch ($this->userModel->register($data)) {
					case true:
						flash("register_success", "You are registered and can log in");
						redirect("users/login");
						break;
					case false:
						die("Something went wrong...");
				}
			}
		}
		return $data;
	}

	/**
	 * @return array
	 */
	public function profile(): array {
		$baseUser = $this->userModel->findUser($_SESSION['user_email']);
		$data = [
			'title' => 'Profile',
			'first_name' => $baseUser->first_name,
			'last_name' => $baseUser->last_name,
			'email' => $baseUser->email,
			'pass' => '',
			'pass_repeat' => '',
			'old_pass' => '',
		];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateChangeProfile($baseUser, $data, $this->userModel);
			if (validRegisterOrChangeInput($data) and empty($data['old_pass_err'])) {
				$formData = $this->userModel->prepareUserEditData();
				$success = $this->userModel->changeUser($baseUser, $formData);
				if ($success) {
					flash("user_change_success", "Your profile was successfully changed!");
					$newUser = $this->userModel->findUser($formData['email']);
					$this->userModel->createSession($newUser, "user");
				} else die("Something went wrong...");
			}
		}
		return $data;
	}

	/**
	 * @return array
	 */
	public function bookings(): array {
		$bookings = $this->userModel->fetchBookings();
		return [
			'title' => 'Bookings',
			'bookings' => $bookings
		];
	}

	/**
	 * @return void
	 */
	public function logout(): void {
		$this->userModel->logout("user");
	}
}