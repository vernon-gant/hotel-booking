<!DOCTYPE html>
<html lang="en">
<head>
	<!--Required meta tags-->
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0"
		  name="viewport">
	<!--Pass title variable according to website content-->
	<title><?php
		if (isset($data['title'])) {
			echo $data['title'];
		} ?>
	</title>
	<!--Required links to css, bootstrap and fontaweasome -->
	<link href="<?php
	echo URL_ROOT; ?>/css/bootstrap.min.css"
		  rel="stylesheet">
	<link href="<?php
	echo URL_ROOT; ?>/css/base.css"
		  rel="stylesheet">
	<link href="https://fonts.googleapis.com"
		  rel="preconnect">
	<link crossorigin
		  href="https://fonts.gstatic.com"
		  rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500;600;700&display=swap"
		  rel="stylesheet">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
			integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"></script>
</head>
