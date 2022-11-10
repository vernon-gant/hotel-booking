<?php

class Booking {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function findAllAvailable(string $arrival, string $departure, int $guests): array {
		$this->db->query("SELECT room_type, description, price * (EXTRACT(DAY FROM ?) - EXTRACT(DAY FROM ?)) as cost
						      FROM `rooms` JOIN room_types rt on rt.name = rooms.room_type
							  WHERE room_num not IN (
							      SELECT room_num
							      FROM reservations
							      WHERE (reservations.arrival between ? and ?) or
							          (reservations.departure between ? and ?)
							  ) AND rt.max_person >= ?
							  GROUP BY room_type"
			,$departure,$arrival,$arrival, $departure, $arrival, $departure, $guests);
		return $this->db->resultSet();
	}

}