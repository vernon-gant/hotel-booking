<?php

class Users extends Controller {

    private User $userModel;

	private Booking $bookingModel;

    public function __construct() {
        $this->userModel = $this->model('User');
		$this->bookingModel = $this->model('Booking');
    }

    /**
     * @return User
     */
    public function getUserModel(): User {
        return $this->userModel;
    }

    public function login() {
		// Init data
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
            validateLoginInput($data,$this);
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

        $this->view('users/login', $data);
    }

    public function registration() {
        // Init data
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
            validateRegisterInput($data,$this);
            // Make sure errors are empty
            if (validRegisterOrChangeInput($data)) {
                $data['pass'] = sha1($data['pass']);
                switch ($this->userModel->register($data)) {
                    case true:
                        flash("register_success","You are registered and can log in");
                        redirect("users/login");
                        return;
                    case false:
                        die("Something went wrong...");
                }
            }

        }
        $this->view('users/registration', $data);
    }

	public function account() {
		$data = array();
		switch (func_get_args()[0]) {
			case "profile" : {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$baseUser = $this->userModel->findUser($_SESSION['user_email']);
					prepareEditProfileData($data,$baseUser);
					validateChangeProfile($baseUser,$data,$this->userModel);
					if (validRegisterOrChangeInput($data) and empty($data['old_pass_err'])) {
						$formData = userFormData();
						$success = $this->getUserModel()->changeUser($baseUser,$formData);
						if ($success) {
							flash("user_change_success","Your profile was successfully changed!");
							$newUser = $this->userModel->findUser($formData['email']);
							$this->userModel->createSession($newUser,"user");
						}
						else die("Something went wrong...");
					}
					$this->view('users/account/profile', $data);
				}
				$baseUser = $this->userModel->findUser($_SESSION['user_email']);
				prepareEditProfileData($data,$baseUser);
				$this->view('users/account/profile', $data);
				break;
			}
			case "bookings" : {
				$this->view('users/account/bookings', $data);
			}
		}
	}

	public function logout() {
		$this->userModel->logout("user");
	}
}