<?php

// Simple page redirect
function redirect($page): void {
    header('Location: ' . URL_ROOT . '/' . $page);
}

function processArrivalDeparture(&$data): void {
	validateArrivalDeparture($data);
	if (validArrivalDeparture($data)) {
		$_SESSION['arrival'] = $data['arrival'];
		$_SESSION['departure'] = $data['departure'];
	} else {
		require_once APPROOT . "/controllers/Pages.php";
		$pages = new Pages();
		call_user_func_array(array($pages,'index'),array($data['arrival_err'], $data['departure_err']));
	}
}

function extractDayFromDate($date) : int {
	$date = DateTime::createFromFormat("Y-m-d",$date);
	return (int) $date->format("d");
}

function mapRoomToPhoto(string $roomType) : string {
	$path = URL_ROOT . "/img/rooms/";
	switch ($roomType) {
		case "Double Suite":
			$path .= "double_suite.jpg";
			break;
		case "Family Suite":
			$path .= "family_suite.jpg";
			break;
		case "Hollywood Twin Room":
			$path .= "hollywood_twin_room.jpg";
			break;
		case "King Standard":
			$path .= "king_standard.jpg";
			break;
		case "Single Room":
			$path .= "single_room.jpg";
	}
	return $path;
}
