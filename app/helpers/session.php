<?php
session_start();

/**
 * Flash message helper.
 * When you want to display a message to the user, you can use this helper.
 * It will store the message in the session and then you can display it in the view.
 * To set a message, call the function with the message as the first parameter, third parameter is optional
 * and is the type of the message (default is 'success').
 * To display the message, call the function with the name as the first parameter.
 * Set - flash('register_success','You are now registered')
 * Display - flash('register_success')
 * @param string $name
 * @param string $message
 * @param string $mode
 * @return void
 */
function flash(string $name = '', string $message = '', string $mode = 'alert-success'): void {
	$class = sprintf('alert %s text-center mt-5', $mode);
	if (!empty($message) && empty($_SESSION[$name])) {
		$_SESSION[$name] = $message;
		$_SESSION[$name . '_class'] = $class;
	} elseif (!empty($_SESSION[$name])) {
		$class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
		echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
		unset($_SESSION[$name], $_SESSION[$name . '_class']);
	}
}

/**
 * Function to save a chosen room in the session.
 * @param DBUtils $utils
 * @return void
 */
function saveRoom(DBUtils $utils): void {
	$_SESSION['booking'] = [
		'room_type' => preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $_REQUEST['room_type']),
		'services' => isset($_REQUEST['services' . $_REQUEST['room_type']]) ? mapServicesToCosts($_REQUEST['services' . $_REQUEST['room_type']], $utils) : null,
		'arrival' => date_create($_REQUEST['arrival']),
		'departure' => date_create($_REQUEST['departure']),
		'guests' => (int)$_REQUEST['guests'],
		'nights' => (int)$_REQUEST['nights'],
		'room_cost' => (int)$_REQUEST['cost' . $_REQUEST['room_type']]
	];
	$_SESSION['booking']['services_cost'] = isset($_SESSION['booking']['services']) ? array_sum(array_values($_SESSION['booking']['services'])) : 0;
	$_SESSION['booking']['total_costs'] = $_SESSION['booking']['services_cost'] + $_SESSION['booking']['room_cost'];
}

/**
 * Saves registered guest in the session.
 * Loops through data array and saves all fields
 * except those with _err suffix.
 * @param $data
 * @return void
 */
function saveGuest($data): void {
	$_SESSION['guest'] = array();
	foreach ($data as $field => $value) {
		if (!str_contains($field, "err"))
			$_SESSION['guest'][$field] = $value;
	}
}
