<?php

class AdminModel {

	private Room $roomModel;

	private Booking $bookingModel;

	private User $userModel;

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

	private Database $db;

	public function __construct() {
		$this->roomModel = new Room();
		$this->bookingModel = new Booking();
		$this->userModel = new User();
		$this->db = new Database();
	}

	public function createAdminSession(mixed $admin): void {
		$_SESSION['admin_email'] = $admin->email;
	}


}