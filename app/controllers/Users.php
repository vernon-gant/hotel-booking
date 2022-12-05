<?php

class Users extends Controller {

    private UserService $userService;

    public function __construct() {
        $this->userService = $this->service('UserService');
    }

    public function login() {
		$data = $this->userService->login();
        $this->view('users/login', $data);
    }

    public function registration() {
        $data = $this->userService->registration();
        $this->view('users/registration', $data);
    }

	public function account() {
		switch (func_get_args()[0]) {
			case "profile" : {
				$data = $this->userService->profile();
				$this->view('users/account/profile', $data);
				break;
			}
			case "bookings" : {
				$data = $this->userService->bookings();
				$this->view('users/account/bookings', $data);
			}
		}
	}

	public function logout() {
		$this->userService->logout();
	}
}