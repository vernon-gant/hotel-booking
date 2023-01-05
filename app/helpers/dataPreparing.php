<?php


function prepareFilteredBookings(Booking $bookingModel, string $status): array {
	return [
		'title' => 'Bookings dashboard',
		'bookings' => $bookingModel->filter($status)
	];
}


function prepareEditUserData(User $userModel, string $email): array {
	return [
		'title' => 'Edit User',
		'user' => $userModel->findUser($email)
	];
}


function prepareUserFormData(): array {
	return [
		'email' => empty(trim($_POST['email'])) ? null : trim($_POST['email']),
		'first_name' => empty(trim($_POST['first_name'])) ? null : trim($_POST['first_name']),
		'last_name' => empty(trim($_POST['last_name'])) ? null : trim($_POST['last_name']),
		'password' => empty(trim($_POST['pass'])) ? null : sha1(trim($_POST['pass']))
	];
}


function prepareAdminUsersData(User $userModel): array {
	return [
		'title' => 'Users dashboard',
		'users' => $userModel->fetchUsers()
	];
}


function prepareBookingDashboardData(Booking $bookingModel): array {
	return [
		'title' => 'Bookings dashboard',
		'bookings' => $bookingModel->fetchAll()
	];
}


function prepareShowBookingData(Booking $bookingModel, string $res_id): array {
	return [
		'title' => 'Booking ' . $res_id,
		'booking' => $bookingModel->fetchSingle($res_id)
	];
}

function prepareAdminLoginData(): array {
	return [
		'title' => 'Admin Login',
		'email' => '',
		'pass' => '',
		'email_err' => '',
		'pass_err' => ''
	];
}


function prepareAddPostData(): array {
	return [
		'title' => 'Add Post',
		'post_title' => '',
		'body' => '',
		'post_title_err' => '',
		'body_err' => ''
	];
}


function preparePost(array $data, Post $postModel, string $adminName): array {
	$id = $postModel->getGenerator()->generate(Post::$idLength);
	return [
		'id' => $id,
		'user_email' => $_SESSION['admin_email'],
		'post_title' => $data['post_title'],
		'body' => $data['body'],
		'img' => processImage($data, $adminName, $id)
	];
}


function preparePostDashboardData(Post $postModel): array {
	return [
		'title' => 'Posts dashboard',
		'posts' => $postModel->getAdminPosts()
	];
}
