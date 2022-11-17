<?php

class Post {

	private Database $db;

	private RandomStringGenerator $generator;

	/**
	 * @return RandomStringGenerator
	 */
	public function getGenerator(): RandomStringGenerator {
		return $this->generator;
	}

	public static int $idLength = 10;

	public function __construct() {
		$this->db = new Database();
		$this->generator = new RandomStringGenerator(implode(range('a', 'z')));
	}

	public function createPost(array $data): bool {
		$this->db->query("INSERT INTO 
    						  posts  (id,user_email, title, body, img)
							  VALUES (?,?,?,?,?);", ...$data);
		return $this->db->affectedRows() > 0;
	}

	public function getAdminPosts(): ?array {
		$this->db->query("SELECT id, title, body, img, posts.created_at, first_name, last_name 
							  FROM posts join users u on u.email = posts.user_email 
							  WHERE user_email = ?", $_SESSION['admin_email']);
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	public function fetchAllPosts(): ?array {
		$this->db->query("SELECT id, title, body, img, posts.created_at, first_name, last_name 
						      FROM posts join users u on u.email = posts.user_email");
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

}