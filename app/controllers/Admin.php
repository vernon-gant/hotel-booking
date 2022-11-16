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