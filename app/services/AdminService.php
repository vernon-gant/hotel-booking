<?php

/**
 * Class containing business logic for admin pages
 * Either returns data or performs actions
 */
class AdminService extends Service {

	private Booking $bookingModel;

	private User $userModel;

	private Post $postModel;

	public function __construct() {
		$this->bookingModel = $this->model("Booking");
		$this->userModel = $this->model("User");
		$this->postModel = $this->model("Post");
	}

	/**
	 * Main page for admin
	 * @return string[]
	 */
	public function index(): array {
		return [
			'title' => 'Admin Dashboard'
		];
	}

	/**
	 * Retrieves all posts for rendering them in the admin dashboard
	 * @return array
	 */
	public function viewPosts(): array {
		return [
			'title' => 'Posts dashboard',
			'posts' => $this->postModel->getAdminPosts()
		];
	}

	/**
	 * Method containing business logic for adding a new post.
	 * Firstly validates title and body, then prepares data for the model.
	 * Finally, saves the post and displays a success message.
	 * @return array
	 */
	public function addPost(): array {
		$data = [
			'title' => 'Add Post',
			'post_title' => isset($_POST['post_title']) ? trim($_POST['post_title']) : "",
			'body' => isset($_POST['body']) ? trim($_POST['body']) : "",
			'image' => $_FILES['image']['name'] ?? null,
		];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validatePost($data);
			if (validPost($data)) {
				$data = $this->preparePost($data);
				if ($this->postModel->createPost($data)) {
					flash("post_added", "Post has been successfully added!");
					redirect("admin/posts/dashboard");
				} else die("Something went wrong...");
			}
		}
		return $data;
	}

	/**
	 * Helper method to prepare data for post to be saved in the database
	 * Generates a unique name for the image using RandomStringGenerator
	 * @param array $data
	 * @return array
	 */
	private function preparePost(array $data): array {
		$id = $this->postModel->getGenerator()->generate(Post::$idLength);
		return [
			'id' => $id,
			'user_email' => $_SESSION['admin_email'],
			'post_title' => $data['post_title'],
			'body' => $data['body'],
			'img' => processImage($data, $this->getEmailName(), $id)
		];
	}

	/**
	 * Returns all users for rendering them in the admin dashboard
	 * @return array
	 */
	public function viewUsers(): array {
		return [
			'title' => 'Users dashboard',
			'users' => $this->userModel->fetchUsers()
		];
	}

	/**
	 * Retrieves specific user for rendering him on user edit page
	 * @param string $email
	 * @return array
	 */
	public function viewEditUserPage(string $email): array {
		return [
			'title' => 'Edit User',
			'user' => $this->userModel->findUser($email)
		];
	}

	/**
	 * Method containing business logic for editing user.
	 * Admin is allowed to set any name, email and password.
	 * But email must be unique.
	 * After performing all validations, saves the user and displays a success message.
	 * @param string $email
	 * @return void
	 */
	public function editUser(string $email): void {
		$baseUser = $this->userModel->findUser($email);
		$formData = $this->userModel->prepareUserEditData();
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

	/**
	 * Method to change user's status.
	 * @param string $email
	 * @return void
	 */
	public function changeUserStatus(string $email): void {
		$this->userModel->changeStatus(email: $email);
	}

	/**
	 * Deletes selected user from the database and displays a message.
	 * @param string $email
	 * @return void
	 */
	public function deleteUser(string $email): void {
		if ($this->userModel->deleteUser(email: $email)) {
			flash("delete_success", "User " . $email . " was successfully deleted!");
		} else {
			flash("delete_error", "Something went wrong...", "alert-danger");
		}
	}

	/**
	 * Returns all bookings for rendering them in the admin dashboard
	 * @return array
	 */
	public function showBookings(): array {
		return [
			'title' => 'Bookings dashboard',
			'bookings' => $this->bookingModel->fetchAll()
		];
	}

	/**
	 * Fetches specific booking for rendering it on the booking show page
	 * @param string $res_id
	 * @return array
	 */
	public function showBooking(string $res_id): array {
		return [
			'title' => 'Booking ' . $res_id,
			'booking' => $this->bookingModel->fetchSingle($res_id)
		];
	}

	/**
	 * Method to change booking's status.
	 * @param string $res_id
	 * @param string $status
	 * @return void
	 */
	public function updateBookingStatus(string $res_id, string $status): void {
		if ($this->bookingModel->changeStatus(res_id: $res_id, status: $status)) {
			redirect("admin/bookings/dashboard");
		} else die("Something went wrong...");
	}

	/**
	 * Method to filter bookings by status and render them in the admin dashboard
	 * @param string $status
	 * @return array
	 */
	public function filterBookings(string $status): array {
		return [
			'title' => 'Bookings dashboard',
			'bookings' => $this->bookingModel->filter($status)
		];
	}

	/**
	 * Method to perform admin login.
	 * Two scenarios are possible:
	 * 1. Get request - renders login page
	 * 2. Post request - validates the form and performs login
	 * @return array
	 */
	public function login(): array {
		$data = [
			'title' => 'Admin Login',
			'email' => isset($_POST['email']) ? trim($_POST['email']) : "",
			'pass' => isset($_POST['pass']) ? sha1($_POST['pass']) : "",
		];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateAdminLogin($data, $this->userModel);
			if (validUser($data)) {
				$admin = $this->userModel->findUser($data['email']);
				$this->userModel->createSession($admin, "admin");
				redirect("admin/index");
			}
		}
		return $data;
	}

	/**
	 * Helper method to get admin's name from email
	 * @return string
	 */
	public function getEmailName(): string {
		return substr($_SESSION['admin_email'],
			0, strpos($_SESSION['admin_email'], "@")
		);
	}

	/**
	 * Performs logout and redirects to the home page
	 * @param string $role
	 * @return void
	 */
	public function logout(string $role): void {
		$this->userModel->logout($role);
	}

}