<?php

/**
 * Post DAO
 */
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

	/**
	 * Executes a query to insert a new post
	 * @param array $data
	 * @return bool
	 */
	public function createPost(array $data): bool {
		$this->db->query("INSERT INTO 
    						  posts  (id,user_email, title, body, img)
							  VALUES (?,?,?,?,?);", ...$data);
		return $this->db->affectedRows() > 0;
	}

	/**
	 * Fetches admin's posts from the database
	 * Used in the admin panel
	 * @return array|null
	 */
	public function getAdminPosts(): ?array {
		$this->db->query("SELECT id, title, body, img, posts.created_at, first_name, last_name 
							  FROM posts join users u on u.email = posts.user_email 
							  WHERE user_email = ?
							  ORDER BY posts.created_at desc", $_SESSION['admin_email']);
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	/**
	 * Fetches all posts from the database
	 * Used on blog page
	 * @return array|null
	 */
	public function fetchAllPosts(): ?array {
		$this->db->query("SELECT id, title, body, img, posts.created_at, first_name, last_name 
						      FROM posts join users u on u.email = posts.user_email
						      ORDER BY posts.created_at desc");
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

}