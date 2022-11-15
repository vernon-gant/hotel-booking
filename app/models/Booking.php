<?php

class Booking {

	private Database $db;

	private RandomStringGenerator $generator;

	private static int $idLength = 10;

	public function __construct() {
		$this->db = new Database();
		$this->generator = new RandomStringGenerator();
	}

	private function generateBookingData(Room $roomModel) :array {
		return [
			'bookingID' => $this->generator->generate(Booking::$idLength),
			'userEmail' => $_SESSION['user_email'],
			'guestID' => $this->createGuest(),
			'roomNum' => $roomModel->findNextFree(),
			'guest' => $_SESSION['booking']['guests'],
			'arrival' => date_format($_SESSION['booking']['arrival'],"Y-m-d"),
			'departure' => date_format($_SESSION['booking']['departure'],"Y-m-d"),
			'total' => $_SESSION['booking']['total_costs'],
		];
	}

	public function createBooking(Room $roomModel) : bool {
		$data = $this->generateBookingData($roomModel);
		$this->db->query("insert into reservations
    						  (res_id, user_email, guest_id, room_num, guests, arrival, departure, total_price)
							  values (?,?,?,?,?,?,?,?)",...$data);
		if ($this->db->affectedRows() > 0) {
			if (isset($_SESSION['booking']['services'])) {
				$success = $this->addReservationServices($data['bookingID']);
				if (!$success) return false;
			}
			if ($this->addReservationEvent($data['bookingID'])) {
				unset($_SESSION['guest'],$_SESSION['booking']);
				return true;
			}
		}
		return false;
	}

	public function addReservationEvent(string $bookingID) : bool {
		$this->db->query("insert into 
    						  reservation_events (res_id, user_email, status, details)
							  values (?,?,?,?)", $bookingID, $_SESSION['user_email'],'new'," ");
		return $this->db->affectedRows() > 0;
	}

	public function addReservationServices(string $bookingID) : bool {
		foreach ($_SESSION['booking']['services'] as $name => $price) {
			$this->db->query("INSERT INTO 
    							  reservation_services (res_id, service_name)
								  VALUES (?,?);",$bookingID,$name);
			if ($this->db->affectedRows() < 1) return false;
		}
		return true;
	}

	public function createGuest() : int {
		$this->db->query("INSERT INTO 
    						  motelx.guests (first_name, last_name, address, city, dob, phone)
							  VALUES (?,?,?,?,?,?)",
			$_SESSION['guest']['first_name'],
			$_SESSION['guest']['last_name'],
			$_SESSION['guest']['address'],
			$_SESSION['guest']['city'],
			$_SESSION['guest']['dob'],
			$_SESSION['guest']['phone']);
		return $this->db->lastInsertID();
	}

}