<?php

class Bookings extends Controller {

	private Booking $bookingModel;

	public function __construct() {
		$this->bookingModel = $this->model("Booking");
	}

	public function index() {
		$data = [
			'title' => 'Booking',
			'arrival' => $_SESSION['arrival'] ?? date_create()->format("Y-m-d"),
			'departure' => $_SESSION['departure'] ?? date_create()->modify("+2 days")->format("Y-m-d"),
			'nights' => 2,
			'guests' => $_GET['guests'] ?? 2,
			'arrival_err' => '',
			'departure_err' => '',
		];

		// Check if redirected from main page with filled formular and validate formular
		if (isset($_GET['arrival'])) processArrivalDeparture($data);

		$data['nights'] = extractDayFromDate($data['departure']) - extractDayFromDate($data['arrival']);
		$data['rooms'] = $this->bookingModel->findAllAvailable($data['arrival'], $data['departure'], $data['guests']);

		$this->view('bookings/rooms', $data);
	}

	public function filter() {

	}
}