<?php

class Booking {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function findAvailable(int $arrivalDay, $departureDay): array {
		$this->db->query("SELECT count(room_num) as 'Available', room_type
						      FROM `rooms`
							  WHERE room_num not IN (
							      SELECT room_num
							      FROM reservations
							      WHERE (EXTRACT(DAY FROM reservations.arrival) between ? and ?) or (EXTRACT(DAY FROM reservations.departure) between ? and ?)
							  )
							  group by room_type"
			, $arrivalDay, $departureDay, $arrivalDay, $departureDay);
		return $this->db->resultSet();
	}

}