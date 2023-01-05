<?php

class AdminService extends Service {

	private Booking $bookingModel;

	private User $userModel;

	private Post $postModel;

	public function __construct() {
		$this->bookingModel = $this->model("Booking");
		$this->userModel = $this->model("User");
		$this->postModel = $this->model("Post");
	}

	public function index() : array {
		if (!isset($_SESSION['admin_email'])) redirect("admin/login");
		return  [
			'title' => 'Admin Dashboard'
		];
	}

	public function viewPosts() : array {
		return preparePostDashboardData($this->postModel);
	}

	public function addPost() : array {
		$data = prepareAddPostData();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			processPost($data);
			if (validPost($data)) {
				$data = preparePost($data, $this->postModel,$this->getEmailName());
				if ($this->postModel->createPost($data)) {
					flash("post_added", "Post has been successfully added!");
					redirect("admin/posts/dashboard");
				} else die("Something went wrong...");
			}
		}
		return $data;
	}

	public function viewUsers() : array {
		return prepareAdminUsersData($this->userModel);
	}

	public function viewEditUserPage(string $email) : array {
		return prepareEditUserData($this->userModel, $email);
	}

	public function editUser(string $email) : void {
		$baseUser = $this->userModel->findUser($email);
		$formData = prepareUserFormData();
		if (validChangeEmail($baseUser, $this->userModel, $formData['email'])) {
			$success = $this->userModel->changeUser($baseUser, $formData);
			if ($success) {
				flash("user_change_success", "User was successfully changed!");
				redirect("admin/users/dashboard");
			} else die("Something went wrong...");
		} else {
			flash("incorrect_email", "This user already exists! Choose other email...", "alert-danger");
			redirect("admin/users/edit/" . $baseUser->email);
		}

	}

	public function changeUserStatus(string $email) : void {
		$this->userModel->changeStatus(email: $email);
	}

	public function deleteUser(string $email) :void {
		$this->userModel->deleteUser(email: $email);
		flash("delete_success", "User " . $email . " was successfully deleted!");
	}

	public function showBookings() : array {
		return prepareBookingDashboardData($this->bookingModel);
	}

	public function showBooking(string $res_id) : array {
		return prepareShowBookingData($this->bookingModel, $res_id);
	}

	public function updateBookingStatus(string $res_id, string $status) : void {
		if ($this->bookingModel->changeStatus(res_id: $res_id, status: $status)) {
			redirect("admin/bookings/dashboard");
		} else die("Something went wrong...");
	}

	public function filterBookings(string $status) : array {
		return prepareFilteredBookings($this->bookingModel, $status);
	}

	public function login() : array {
		$data = prepareAdminLoginData();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateAdminLogin($data, $this->userModel);
			if (validUser($data)) {
				$admin = $this->userModel->findUser($data['email']);
				$this->userModel->createSession($admin,"admin");
				redirect("admin/index");
			}
		}
		return $data;
	}

	public function getEmailName(): string {
		return substr($_SESSION['admin_email'],
			0, strpos($_SESSION['admin_email'], "@")
		);
	}

	public function logout(string $role) : void {
		$this->userModel->logout($role);
	}

}