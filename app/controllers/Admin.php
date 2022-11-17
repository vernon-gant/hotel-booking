<?php

class Admin extends Controller {

	private AdminModel $adminModel;

	private array $data;

	public function __construct() {
		$this->adminModel = $this->model("AdminModel");
		$this->data = array();
	}

	public function index() {
		if (!isset($_SESSION['admin_email'])) redirect("admin/login");

		$this->view("admin/index",$this->data);
	}

	public function posts() {
		$methodArgs = func_get_args();
		switch (true) {
			case in_array("add",$methodArgs) : {
				prepareAddPostData($this->data);
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					processPost($this->data);
					if (validPost($this->data)) {
						$this->data = preparePost($this->data,$this->adminModel);
						if ($this->adminModel->getPostModel()->createPost($this->data)) {
							flash("post_added","Post has been successfully added!");
							redirect("admin/posts/dashboard");
							return;
						} else die("Something went wrong...");
					}
				}
				$this->view("admin/posts/add",$this->data);
				break;
			}
			case in_array("delete",$methodArgs) : {
				$id = $methodArgs[1];
				break;
			}
			default : {
				preparePostDashboardData($this->data,$this->adminModel->getPostModel());
				$this->view("admin/posts/dashboard",$this->data);
			}
		}
	}

	public function login() {
		prepareAdminLoginData($this->data);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateAdminLogin($this->data,$this->adminModel);
			if (validUser($this->data)) {
				$admin = $this->adminModel->getUserModel()->findUser($this->data['email']);
				$this->adminModel->createAdminSession($admin);
				redirect("admin/index");
			}
		}
		$this->view("admin/login",$this->data);
	}

	public function logout() {
		$this->adminModel->getUserModel()->logout("admin");
	}

}