<?php

class Bookings extends Controller {

	private BookingService $bookingService;

	public function __construct() {
		$this->bookingService = $this->service("BookingService");
	}

	public function index() {
		$data = $this->bookingService->index();
		$this->view('bookings/rooms', $data);
	}

	public function filter() {
		$data = $this->bookingService->filter();
		$this->view('bookings/rooms', $data);
	}

	public function guest() {
		$data = $this->bookingService->guests();
		$this->view("bookings/guest",$data);
	}

	public function checkout() {
		$data = $this->bookingService->checkout();
		$this->view("bookings/checkout",$data);
	}
}