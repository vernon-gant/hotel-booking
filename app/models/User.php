<?php

class User {

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function emailExists($email): bool {
        $this->db->query("SELECT * FROM users where email = :email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function correctPassword(string $email, string $password) : bool {
        $this->db->query("SELECT * FROM users where email = :email AND password = :password");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function findUser(string $email) : mixed {
        $this->db->query("SELECT * FROM users where email = :email");
        $this->db->bind(':email', $email);
        return $this->db->singleRow();
    }

    public function register($data): bool {
        $this->db->query("INSERT INTO users (email, password, first_name, last_name,role) VALUES (:email, :pass, :first_name, :last_name, :role)");
        // Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':role', "User");

        return $this->db->execute();
    }

    public function createSession($user) : void {
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_first_name'] = $user->first_name;
        $_SESSION['user_last_name'] = $user->last_name;
        redirect("pages/index");
    }

	public function logout() : void {
		unset($_SESSION['user_email'], $_SESSION['user_first_name'], $_SESSION['user_last_name']);
		redirect("pages/index");
	}
}