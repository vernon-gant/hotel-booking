<?php

class Booking {

	private Database $db;

	private RandomStringGenerator $generator;

	private int $idLength = 10;

	public function __construct() {
		$this->db = new Database();
		$this->generator = new RandomStringGenerator();
	}

	public function createBooking() : bool {
		return true;
	}

}