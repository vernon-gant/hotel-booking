<?php

class AdminModel {

	private Room $roomModel;

	private Booking $bookingModel;

	private User $userModel;

	private Database $db;

	public function __construct() {
		$this->roomModel = new Room();
		$this->bookingModel = new Booking();
		$this->userModel = new User();
		$this->db = new Database();
	}

	public function adminEmailExists($email): bool {
		$this->db->query("SELECT * FROM users WHERE email = ? AND role = 'Admin'", $email);
		return $this->db->rowCount() > 0;
	}

	public function correctAdminPassword(string $email, string $password): bool {
		$this->db->query("SELECT * FROM users where email = ? AND password = ? AND role = 'Admin'", $email, $password);
		return $this->db->rowCount() > 0;
	}

	public function findAdmin(string $email): mixed {
		return $this->userModel->findUser($email);
	}

	public function createSession(mixed $admin): void {
		$_SESSION['admin_email'] = $admin->email;
	}


}