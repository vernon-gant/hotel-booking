<?php

/**
 *
 */
class BookingService extends Service {

	private Room $roomModel;

	private Booking $bookingModel;

	private DBUtils $utils;

	public function __construct() {
		$this->roomModel = $this->model("Room");
		$this->bookingModel = $this->model("Booking");
		$this->utils = new DBUtils();
	}

	/**
	 * @return array
	 */
	public function index(): array {
		$data = [
			'title' => 'Booking',
			'arrival' => $_SESSION['arrival'] ?? date_create()->format("Y-m-d"),
			'departure' => $_SESSION['departure'] ?? date_create()->modify("+2 days")->format("Y-m-d"),
			'guests' => $_GET['guests'] ?? 1,
		];

		// Check if redirected from main page with filled form and validate the data
		if (isset($_GET['arrival'])) {
			processArrivalDeparture($data);
		}

		$data['nights'] = computeNights($data['departure'],$data['arrival']);
		$data['rooms'] = $this->roomModel->findAllAvailable($data['arrival'], $data['departure'], $data['guests']);

		return $data;
	}

	/**
	 * @return array
	 */
	public function filter(): array {
		$data = [
			'title' => 'Booking',
			'arrival' => $_GET['arrival'],
			'departure' => $_GET['departure'],
			'nights' => $_GET['nights'],
			'guests' => $_GET['guests'],
		];
		$data['rooms'] = $this->roomModel->filterRooms($data);
		return $data;
	}

	/**
	 * @return string[]
	 */
	public function guests(): array {
		$data = [
			'title' => 'Guest info',
			'first_name' => isset($_POST['first_name']) ? trim($_POST['first_name']) : "",
			'last_name' => isset($_POST['last_name']) ? trim($_POST['last_name']) : "",
			'address' => isset($_POST['address']) ? trim($_POST['address']) : "",
			'city' => isset($_POST['city']) ? trim($_POST['city']) : "",
			'country' => isset($_POST['country']) ? trim($_POST['country']) : "",
			'zip' =>isset($_POST['country']) ? trim($_POST['country']) : "",
			'dob' =>isset($_POST['dob']) ? trim($_POST['dob']) : "",
			'phone' =>isset($_POST['phone']) ? trim($_POST['phone']) : "",
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			validateGuest($data);
			if (validGuest($data)) {
				saveGuest($data);
				redirect("bookings/checkout");
			}
		} else saveRoom($this->utils);

		return $data;
	}

	/**
	 * @return array
	 */
	public function checkout(): array {
		$data = [
			'title' => 'Checkout',
			'booking' => $_SESSION['booking'],
			'guest' => $_SESSION['guest'],
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$bookingCreated = $this->bookingModel->createBooking($this->roomModel);
			if ($bookingCreated) {
				flash("booking_created", "You have successfully made a booking!");
				redirect("pages/index");
			} else die("ERROR");
		}

		return $data;
	}

}