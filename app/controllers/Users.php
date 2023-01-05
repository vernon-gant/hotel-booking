<?php

/**
 * Controller class for handling user requests.
 * Uses UserService to handle business logic.
 */
class Users extends Controller {

    private UserService $userService;

    public function __construct() {
        $this->userService = $this->service('UserService');
    }

	/**
	 * Method for handling login requests.
	 * @return void
	 */
	public function login() : void {
		$data = $this->userService->login();
        $this->view('users/login',$data);
    }

	/**
	 * Method for handling registration requests.
	 * @return void
	 */
	public function registration(): void {
        $data = $this->userService->registration();
        $this->view('users/registration',$data);
    }

	/**
	 * Method for handling account requests.
	 * Two possible scenarios:
	 * 1. Profile page is requested.
	 * 2. Booking history is requested.
	 * @return void
	 */
	public function account(): void {
		switch (func_get_args()[0]) {
			case "profile" : {
				$data = $this->userService->profile();
				$this->view('users/account/profile',$data);
				break;
			}
			case "bookings" : {
				$data = $this->userService->bookings();
				$this->view('users/account/bookings',$data);
			}
		}
	}

	/**
	 * Logs out the user.
	 * @return void
	 */
	public function logout(): void {
		$this->userService->logout();
	}
}