<?php

class Admin extends Controller {

	private AdminService $adminService;

	public function __construct() {
		$this->adminService = $this->service("AdminService");
	}

	public function index() {
		$data = $this->adminService->index();
		$this->view("admin/index", $data);
	}

	public function posts() {
		$methodArgs = func_get_args();
		switch (true) {
			case in_array("add", $methodArgs) :
			{
				$data = $this->adminService->addPost();
				$this->view("admin/posts/add", $data);
				break;
			}
			case in_array("delete", $methodArgs) :
			{
				$id = $methodArgs[1];
				break;
			}
			default :
			{
				$data = $this->adminService->viewPosts();
				$this->view("admin/posts/dashboard", $data);
			}
		}
	}

	public function users() {
		$methodArgs = func_get_args();

		if (in_array("delete", $methodArgs)) {
			$this->adminService->deleteUser($methodArgs[1]);
		}
		elseif (in_array("edit", $methodArgs)) {

			switch ($_SERVER['REQUEST_METHOD']) {
				case 'GET':
				{
					$data = $this->adminService->viewEditUserPage($methodArgs[1]);
					$this->view("admin/users/edit", $data);
					return;
				}
				case 'POST':
				{
					$this->adminService->editUser($methodArgs[1]);
				}
			}
		} else {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') $this->adminService->changeUserStatus(email: $_POST['user_email']);
		}

		$data = $this->adminService->viewUsers();

		$this->view("admin/users/dashboard", $data);
	}

	public function bookings() {
		$methodArgs = func_get_args();
		switch (true) {
			case in_array("show", $methodArgs) : {
				$data = $this->adminService->showBooking($methodArgs[1]);
				$this->view("admin/bookings/show", $data);
				return;
			}
			case in_array("update", $methodArgs) : {
				$this->adminService->updateBookingStatus(res_id: $methodArgs[1], status: $_POST['status']);
				return;
			}
			case in_array("filter", $methodArgs) : {
				$data = $this->adminService->filterBookings($methodArgs[1]);
				break;
			}
			default : $data = $this->adminService->showBookings();
		}
		$this->view("admin/bookings/dashboard", $data);
	}

	public function login() {
		$data = $this->adminService->login();
		$this->view("admin/login", $data);
	}

	public function logout() {
		$this->adminService->logout("admin");
	}

}