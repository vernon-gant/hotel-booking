<?php
session_start();

// Flash message helper
// Example - flash('register_success','You are now registered')

function flash($name = '', $message = '', $class = 'alert alert-success') : void {
    if (!empty($message) && empty($_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    } elseif(!empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name],$_SESSION[$name . '_class']);
    }
}

function saveRoom(DBUtils $utils) : void {
	$_SESSION['booking'] = [
		'room_type' => $_GET['room_type'],
		'room_services' => isset($_GET['services' . $_GET['room_type']]) ? mapServicesToCosts($_GET['services' . $_GET['room_type']],$utils) : null,
		'arrival' => date_create($_GET['arrival']),
		'departure' => date_create($_GET['departure']),
		'guests' => (int) $_GET['guests'],
		'nights' => (int) $_GET['nights'],
		'room_cost' => (int) $_GET['cost' . $_GET['room_type']]
	];
	$_SESSION['booking']['services_cost'] = isset($_SESSION['booking']['room_services']) ? $_SESSION['booking']['room_services']->sum() : 0;
	$_SESSION['booking']['total_costs'] = $_SESSION['booking']['services_cost'] + $_SESSION['booking']['room_cost'];
}

function saveGuest($data) : void {
	$_SESSION['guest'] = array();
	foreach ($data as $field => $value) {
		if (!str_contains($field,"err")) $_SESSION['guest'][$field] = $value;
	}
}
