<?php

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
		} else unset($_SESSION['arrival'], $_SESSION['departure']);
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

function extractPrice(string $priceRange): array {
	return array_map(fn($price): int => (int)trim($price), explode("-", $priceRange));
}

function filterGet(): void {
	$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function filterPost(): void {
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function mapServicesToCosts(array $userServices, DBUtils $utils): array {
	$allServices = $utils->findServicesPrices();
	$result = array();
	foreach ($allServices as $service) {
		if (in_array($service['name'], $userServices)) {
			$result[$service['name']] = $service['price'];
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
		'pass_err' => ''
	];
}

function prepareAddPostData(array &$data): void {
	$data = [
		'title' => 'Add Post',
		'post_title' => '',
		'body' => '',
		'post_title_err' => '',
		'body_err' => ''
	];
}

function preparePost(array $data, AdminModel $adminModel): array {
	$id = $adminModel->getPostModel()->getGenerator()->generate(Post::$idLength);
	return [
		'id' => $id,
		'user_email' => $_SESSION['admin_email'],
		'post_title' => $data['post_title'],
		'body' => $data['body'],
		'img' => processImage($data, $adminModel, $id)
	];
}

function preparePostDashboardData(array &$data, Post $postModel): void {
	$data = [
		'title' => 'Posts dashboard',
		'posts' => $postModel->getAdminPosts()
	];
}

function mapImagePathToPhoto(string $path): string {
	return URL_ROOT . "/public/img/blog/" . $path;
}

function prepareAdminUsersData(array &$data, User $userModel): void {
	$data = [
		'title' => 'Users dashboard',
		'users' => $userModel->fetchUsers()
	];
}

function prepareBookingDashboardData(array &$data, Booking $bookingModel): void {
	$data = [
		'title' => 'Bookings dashboard',
		'bookings' => $bookingModel->fetchAll()
	];
}

function prepareShowBookingData(array &$data, Booking $bookingModel, string $res_id): void {
	$data = [
		'title' => 'Booking ' . $res_id,
		'booking' => $bookingModel->fetchSingle($res_id)
	];
}

function processImage(array $data, AdminModel $adminModel, string $id): ?string {
	if ($data['image'] == null)
		return null;
	else {
		$userName = $adminModel->getEmailName();
		$blogPath = "../public/img/blog/";
		$userDir = $blogPath . $userName;
		$userDirExists = file_exists($userDir) and is_dir($userDir);
		if (!$userDirExists)
			mkdir($userDir, 0777, true);
		$img_path = "/post_" . $id . ".jpg";
		$success = createThumb($_FILES['image']["tmp_name"], $userDir . $img_path);
		return $success ? $userName . $img_path : null;
	}
}

function createThumb($sourceImagePath, $destImagePath): bool {
	$sourceImage = imagecreatefromjpeg($sourceImagePath);
	$orgWidth = imagesx($sourceImage);
	$orgHeight = imagesy($sourceImage);
	$thumbWidth = 720;
	$thumbHeight = 480;
	$destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
	$success = imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);
	imagejpeg($destImage, $destImagePath);
	imagedestroy($sourceImage);
	imagedestroy($destImage);
	return $success;
}

function prepareFilteredBookings(array &$data, Booking $bookingModel, string $status): void {
	$data = [
		'title' => 'Bookings dashboard',
		'bookings' => $bookingModel->filter($status)
	];
}

function prepareEditUserData(array &$data, User $userModel, string $email): void {
	$data = [
		'title' => 'Edit User',
		'user' => $userModel->findUser($email)
	];
}

function userFormData(): array {
	filterPost();
	return [
		'email' => empty(trim($_POST['email'])) ? null : trim($_POST['email']),
		'first_name' => empty(trim($_POST['first_name'])) ? null : trim($_POST['first_name']),
		'last_name' => empty(trim($_POST['last_name'])) ? null : trim($_POST['last_name']),
		'password' => empty(trim($_POST['pass'])) ? null : sha1(trim($_POST['pass']))
	];
}

