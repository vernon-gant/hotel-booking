<?php

use Ds\Map;

require_once APPROOT . "/helpers/DBUtils.php";


// Simple page redirect
function redirect($page): void {
	header('Location: ' . URL_ROOT . '/' . $page);
}

function processArrivalDeparture(&$data): void {
	validateArrivalDeparture($data);
	if (validArrivalDeparture($data)) {
		if (!isset($_SESSION['user_email'])) {
			$_SESSION['arrival'] = $data['arrival'];
			$_SESSION['departure'] = $data['departure'];
			redirect("users/login");
		} else unset($_SESSION['arrival'],$_SESSION['departure']);
	} else {
		$redirectedFromIndex = !str_contains($_SERVER['HTTP_REFERER'], "bookings");
		if ($redirectedFromIndex) {
			require_once APPROOT . "/controllers/Pages.php";
			$pages = new Pages();
			call_user_func_array(array($pages, 'index'), array($data['arrival_err'], $data['departure_err']));
		}
	}
}

function extractDayFromDate($date): int {
	$date = DateTime::createFromFormat("Y-m-d", $date);
	return (int)$date->format("d");
}

function mapRoomToPhoto(string $roomType): string {
	$path = URL_ROOT . "/img/rooms/";
	switch ($roomType) {
		case "Double Suite":
			$path .= "d_suite.jpg";
			break;
		case "Family Suite":
			$path .= "f_suite.jpg";
			break;
		case "Hollywood Twin Room":
			$path .= "h_twin_room.jpg";
			break;
		case "King Standard":
			$path .= "k_standard.jpg";
			break;
		case "Single Room":
			$path .= "s_room.jpg";
	}
	return $path;
}

function extractPrice(string $priceRange) : array {
	return array_map(fn ($price):int =>  (int) trim($price),explode("-",$priceRange));
}

function filterGet() : void {
	$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function filterPost() : void {
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function mapServicesToCosts(array $userServices, DBUtils $utils) : ?Map {
	$allServices = $utils->findServicesPrices();
	$result = new Map();
	foreach ($allServices as $service) {
		if (in_array($service['name'],$userServices)) {
			$result->put($service['name'],$service['price']);
		}
	}
	return $result;
}

function prepareAdminLoginData(array &$data): void {
	$data = [
		'title' => 'Admin Login',
		'email' => '',
		'pass' => '',
		'email_err' => '',
		'pass_err' =>''
	];
}

function prepareAdminBlogData(array &$data): void {
	$data = [
		'title' => 'Posts Overview',
		'posts' => null
	];
}
