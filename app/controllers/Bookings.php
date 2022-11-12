<?php

class Bookings extends Controller {

	private Room $roomModel;

	public function __construct() {
		$this->roomModel = $this->model("Room");
	}

	public function index() {
		filterGet();
		$data = [
			'title' => 'Booking',
			'arrival' => $_SESSION['arrival'] ?? date_create()->format("Y-m-d"),
			'departure' => $_SESSION['departure'] ?? date_create()->modify("+2 days")->format("Y-m-d"),
			'nights' => 2,
			'guests' => $_GET['guests'] ?? 1,
			'arrival_err' => '',
			'departure_err' => '',
		];

		// Check if redirected from main page with filled formular and validate formular
		if (isset($_GET['arrival'])) processArrivalDeparture($data);

		$data['nights'] = extractDayFromDate($data['departure']) - extractDayFromDate($data['arrival']);
		$data['rooms'] = $this->roomModel->findAllAvailable($data['arrival'], $data['departure'], $data['guests']);

		$this->view('bookings/rooms', $data);
	}

	public function filter() {
		filterGet();
		$data = [
			'title' => 'Booking',
			'arrival' => $_GET['arrival'],
			'departure' => $_GET['departure'],
			'nights' => $_GET['nights'],
			'guests' => $_GET['guests'],
			'arrival_err' => '',
			'departure_err' => '',
		];
		$data['rooms'] = $this->roomModel->filterRooms($data);
		$this->view('bookings/rooms', $data);
	}

	public function guest() {
		filterGet();

		$data = [
			'title' => 'Guest info',
			'first_name' => '',
			'last_name' => '',
			'address' => '',
			'city' => '',
			'country' => '',
			'zip' => '',
			'dob' => '',
			'phone' => '',
			'fname_err' => '',
			'lname_err' => '',
			'address_err' => '',
			'city_err' => '',
			'country_err' => '',
			'zip_err' => '',
			'dob_err' => '',
			'phone_err' => ''
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateGuest($data);
			if (validGuest($data)) {
				saveGuest($data);
				redirect("bookings/checkout");
				return;
			}
		} else saveRoom();

		$this->view("bookings/guest",$data);
	}

	public function checkout() {
		$data = [
			'booking' => $_SESSION['booking'],
			'guest' => $_SESSION['guest'],
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateGuest($data);
			if (validGuest($data)) {
				saveGuest($data);
				redirect("bookings/checkout");
				return;
			}
		}

		$this->view("bookings/checkout",$data);
	}
}