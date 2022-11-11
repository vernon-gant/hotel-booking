<?php

class User {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function emailExists($email): bool {
		$this->db->query("SELECT * FROM users where email = ?", $email);
		return $this->db->rowCount() > 0;
	}

	public function correctPassword(string $email, string $password): bool {
		$this->db->query("SELECT * FROM users where email = ? AND password = ?", $email, $password);
		return $this->db->rowCount() > 0;
	}

	public function findUser(string $email): mixed {
		$this->db->query("SELECT * FROM users where email = ?", $email);
		return $this->db->singleRow();
	}

	public function register($data): bool {
		$this->db->query("INSERT INTO users (email, password, first_name, last_name,role) VALUES (?, ?, ?, ?, ?)",
			$data['email'], $data['pass'],$data['first_name'],$data['last_name'],"User");
		return $this->db->affectedRows() > 0;
	}

	public function createSession($user): void {
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_first_name'] = $user->first_name;
		$_SESSION['user_last_name'] = $user->last_name;
	}

	public function logout(): void {
		unset($_SESSION['user_email'], $_SESSION['user_first_name'], $_SESSION['user_last_name']);
		session_destroy();
		redirect("pages/index");
	}
}