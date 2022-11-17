<?php

class AdminModel {

	private Room $roomModel;

	private Booking $bookingModel;

	private User $userModel;

	private Post $postModel;

	private Database $db;

	/**
	 * @return Post
	 */
	public function getPostModel(): Post {
		return $this->postModel;
	}

	/**
	 * @return Room
	 */
	public function getRoomModel(): Room {
		return $this->roomModel;
	}

	/**
	 * @return Booking
	 */
	public function getBookingModel(): Booking {
		return $this->bookingModel;
	}

	/**
	 * @return User
	 */
	public function getUserModel(): User {
		return $this->userModel;
	}

	/**
	 * @return Database
	 */
	public function getDb(): Database {
		return $this->db;
	}

	public function __construct() {
		$this->roomModel = new Room();
		$this->bookingModel = new Booking();
		$this->userModel = new User();
		$this->postModel = new Post();
		$this->db = new Database();
	}

	public function createAdminSession(mixed $admin): void {
		$_SESSION['admin_email'] = $admin->email;
	}

	public function getEmailName(): string {
		return substr($_SESSION['admin_email'],
			0, strpos($_SESSION['admin_email'], "@")
		);
	}


}