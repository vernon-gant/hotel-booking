<?php

class Booking {

	private Database $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function findAllAvailable(string $arrival, string $departure, int $guests): ?array {
		$this->db->query("SELECT room_type, description, price * (EXTRACT(DAY FROM ?) - EXTRACT(DAY FROM ?)) as cost, pets_allowed
						      FROM `rooms` JOIN room_types rt on rt.name = rooms.room_type
							  WHERE room_num not IN (
							      SELECT room_num
							      FROM reservations
							      WHERE (reservations.arrival between ? and ?) or
							          (reservations.departure between ? and ?)
							  ) AND rt.max_person >= ?
							  GROUP BY room_type"
			, $departure, $arrival, $arrival, $departure, $arrival, $departure, $guests);
		if ($this->db->rowCount() > 0) return $this->db->resultSet();
		else return null;
	}

	public function filterRooms(array &$data): ?array {
		$filters = [
			'price' => isset($_GET['price']) ? extractPrice($_GET['price']) : null,
			'floor' => $_GET['floor'] ?? null,
			'pets' => isset($_GET['pets']) ? (int) $_GET['pets'] : null,
		];
		$data = array_merge($data,$filters);

		$statementBuilder = (new FilterStatementBuilder
		("SELECT room_type, description, price * (EXTRACT(DAY FROM ?) - EXTRACT(DAY FROM ?)) as cost, pets_allowed
						      FROM `rooms` JOIN room_types rt on rt.name = rooms.room_type
							  WHERE room_num not IN (
							      SELECT room_num
							      FROM reservations
							      WHERE (reservations.arrival between ? and ?) or
							          (reservations.departure between ? and ?)
							  ) AND rt.max_person >= ?",
			   [$data['departure'], $data['arrival'], $data['arrival'],
				$data['departure'], $data['arrival'], $data['departure'], $data['guests']]
		))->build($filters);

		$this->db->query($statementBuilder->getQuery(),...$statementBuilder->getArgs());
		return $this->db->rowCount() > 0 ? $this->db->resultSet() : null;
	}

}