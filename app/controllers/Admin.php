<?php

/**
 * This is an admin controller class which is
 * responsible for executing the admin's actions
 * using admin service with all the logic there
 * and rendering specific view depending on the request
 */
class Admin extends Controller {

	/**
	 * @var AdminService|mixed
	 * Admin service instance
	 */
	private AdminService $adminService;

	public function __construct() {
		$this->adminService = $this->service("AdminService");
	}

	/**
	 * This method is responsible for rendering
	 * admin index page
	 * @return void
	 */
	public function index() {
		$data = $this->adminService->index();
		$this->view("admin/index",$data);
	}

	/**
	 * This method is an entry point for admin posts
	 * actions: add, delete and view.
	 * Link to this method is /admin/posts/{action}
	 * @return void
	 */
	public function posts() {
		$methodArgs = func_get_args();
		switch (true) {
			case in_array("add", $methodArgs) :
			{
				$data = $this->adminService->addPost();
				$this->view("admin/posts/add",$data);
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
				$this->view("admin/posts/dashboard",$data);
			}
		}
	}

	/**
	 * This method is an entry point for admin users
	 * actions: add, delete and view.
	 * Link to this method is /admin/users/{action}
	 * 1. First "if" statement checks if delete action is requested
	 * 2. Second "elseif" statement checks if edit action is requested,
	 * checks request method and if it is POST, then it calls
	 * editUser method from admin service and passes the id of the user
	 * if it is GET, then it renders edit user view
	 * 3. Last else statement is responsible for changing user's status
	 * Finally, it renders users dashboard view
	 * @return void
	 */
	public function users(): void {
		$methodArgs = func_get_args();

		if (in_array("delete", $methodArgs)) {
			$this->adminService->deleteUser($methodArgs[1]);
		}
		elseif (in_array("edit", $methodArgs)) {

			switch ($_SERVER['REQUEST_METHOD']) {
				case 'GET':
				{
					$data = $this->adminService->viewEditUserPage($methodArgs[1]);
					$this->view("admin/users/edit",$data);
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

		$this->view("admin/users/dashboard",$data);
	}

	/**
	 * This method is an entry point for admin bookings actions:
	 * show, update and filter.
	 * @return void
	 */
	public function bookings(): void {
		$methodArgs = func_get_args();
		switch (true) {
			case in_array("show", $methodArgs) : {
				$data = $this->adminService->showBooking($methodArgs[1]);
				$this->view("admin/bookings/show",$data);
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
		$this->view("admin/bookings/dashboard",$data);
	}

	/**
	 * @return void
	 */
	public function login() {
		$data = $this->adminService->login();
		$this->view("admin/login",$data);
	}

	/**
	 * @return void
	 */
	public function logout() {
		$this->adminService->logout("admin");
	}

}