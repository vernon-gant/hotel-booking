<?php

class Bookings extends Controller {

	private Booking $bookingModel;

	public function __construct() {
		$this->bookingModel = $this->model("Booking");
	}

	public function index() {
		$data = [
			'title' => 'Booking',
			'arrival' => date_create()->format("y-m-d"),
			'departure' => date_create()->modify("+1 year")->format("y-m-d"),
			'guests' => $_GET['guests'] ?? 1,
			'arrival_err' => '',
			'departure_err' => '',
		];

		// Check if redirected from main page with filled formular and validate formular
		if (isset($_GET['arrival']))
			processArrivalDeparture($data);
		// Check if logged in
		if (!isset($_SESSION['user_email']))
			redirect("users/login");

		$data['rooms'] = $this->bookingModel->findAllAvailable($data['arrival'],
			$data['departure'], $data['guests']);

		$this->view('bookings/rooms', $data);
	}

	public function filter() {

	}
}