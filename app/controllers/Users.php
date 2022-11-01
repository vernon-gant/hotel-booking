<?php

class Users extends Controller {

    private User $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
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
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            validateLoginInput($data,$this);
            // Check if empty errors
            if (validUser($data)) {
                $user = $this->userModel->findUser($data['email']);
                $this->userModel->createSession($user);
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
            'pass_error' => '',
            'pass_repeat_err' => ''
        ];

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            validateRegisterInput($data,$this);
            // Make sure errors are empty
            if (validRegisterInput($data)) {
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

	public function book() {
		// Init data
		$data = [
			'title' => 'Booking',
			'email' => '',
			'pass' => '',
			'email_err' => '',
			'pass_err' => '',
		];

		$this->view('users/book', $data);
	}

	public function logout() {
		$this->userModel->logout();
	}
}