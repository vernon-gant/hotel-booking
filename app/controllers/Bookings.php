<?php

/**
 * Controller class for handling booking requests.
 * Depicts whole booking process: from selecting a room to making a payment.
 * Uses BookingService to handle business logic.
 */
class Bookings extends Controller {

	private BookingService $bookingService;

	public function __construct() {
		$this->bookingService = $this->service("BookingService");
	}

	/**
	 * Renders a page with a list of available rooms
	 * with data obtained from BookingService.
	 * @return void
	 */
	public function index(): void {
		$data = $this->bookingService->index();
		$this->view('bookings/rooms',$data);
	}

	/**
	 * Filters available rooms by given parameters.
	 * @return void
	 */
	public function filter(): void {
		$data = $this->bookingService->filter();
		$this->view('bookings/rooms',$data);
	}

	/**
	 * Renders a page with a form for registering a new guest.
	 * @return void
	 */
	public function guest(): void {
		$data = $this->bookingService->guests();
		$this->view("bookings/guest",$data);
	}

	/**
	 * Renders a checkout page with a form for making a payment.
	 * @return void
	 */
	public function checkout(): void {
		$data = $this->bookingService->checkout();
		$this->view("bookings/checkout",$data);
	}
}