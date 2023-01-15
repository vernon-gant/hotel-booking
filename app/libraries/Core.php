<?php

/**
 * App core class
 * Creates URL and loads controllers
 * URL FORMAT - /controllers/method/params
 * Also checks if the url call is a valid call.
 * If not, shows a flash message and redirects to a specified page.
 */
class Core {

	private mixed $currentController = 'Pages';

	private string $currentMethod = 'index';

	public function __construct() {
		$this->filterGetPost();
		$url = $this->getUrl();
		if ($this->validPageCall($url))
			$this->redirect($url);
	}

	/**
	 * Function responsible for instantiating controller class and calling its method
	 * @param array $url
	 * @return void
	 */
	private function redirect(array &$url): void {
		// Look in controllers for first value
		if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
			// If exists set as controllers
			$this->currentController = ucwords($url[0]);
		}
		// Unset 0 Index
		unset($url[0]);

		// Require the controllers
		require_once '../app/controllers/' . $this->currentController . '.php';

		// Instantiate controllers class
		$this->currentController = new $this->currentController;

		// Check for second part of url
		if (isset($url[1]) and method_exists($this->currentController, $url[1])) {
			$this->currentMethod = $url[1];
		}
		// Unset method in array
		unset($url[1]);
		$params = $url ? array_values($url) : [];
		call_user_func_array([$this->currentController, $this->currentMethod], $params);
	}

	/**
	 * Simple sanitization of $_GET and $_POST
	 * @return void
	 */
	private function filterGetPost(): void {
		if (isset($_GET)) {
			foreach ($_GET as $key => $value) {
				$_GET[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
		}
		if (isset($_POST)) {
			foreach ($_POST as $key => $value) {
				$_POST[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
		}
	}

	/**
	 * Call validation function and if it returns false, show flash message and redirect to specified page.
	 * @param array $url
	 * @return bool
	 */
	private function validPageCall(array $url): bool {
		// Logged in as admin and trying to access a page that is not allowed
		if (isset($_SESSION['admin_email']) and !in_array("admin", $url)) {
			flash("admin_logout_needed", "You must logout to access other pages! Please, log out.", "alert-danger");
			redirect("admin/index");
			return false;
			// Logged-in user tries to access admin page
		} elseif (isset($_SESSION['user_email']) and in_array("admin", $url)) {
			flash("user_logout_needed", "You must logout to access admin panel! Please, log out.", "alert-danger");
			redirect("pages/index");
			return false;
			// Not logged in as admin and trying to access admin panel
		} elseif ($url[0] == 'admin' and !isset($_SESSION['admin_email']) and $url[1] != 'login') {
			flash("admin_login_needed", "You must be logged in as admin to view this page! Please, log in.", "alert-danger");
			redirect("admin/login");
			return false;
			// Not logged in as user and trying to access booking pages not from main page date form
		} elseif ($url[0] == 'bookings' and !isset($_SESSION['user_email']) and !isset($_GET['arrival']) and !isset($_GET['departure'])) {
			flash("booking_rejected", "You must be logged in as user to book a room! Please, log in.", "alert-danger");
			redirect("pages/index");
			return false;
			// Not logged in as user and trying to perform user actions
		} elseif ($url[0] == 'users' and !($url[1] == 'login' or $url[1] == 'registration') and !isset($_SESSION['user_email'])) {
			flash("user_login_needed", "You must be logged in as user to view this page! Please, log in.", "alert-danger");
			redirect("users/login");
			return false;
		}
		return true;
	}

	/**
	 * Method responsible for getting url and returning it as an array
	 * @return array|string[]
	 */
	public function getUrl(): array {
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			return explode('/', $url);
		}
		return [$this->currentController];
	}
}