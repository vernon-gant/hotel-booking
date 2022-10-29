<!DOCTYPE html>
<html lang="en">
<head>
	<!--Required meta tags-->
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0"
	      name="viewport">
	<!--Pass title variable according to website content-->
	<title><?php if (isset($data['title'])) {
			echo $data['title'];
		} ?>
	</title>
	<!--Required links to css, bootstrap and fontaweasome -->
	<link href="<?php echo URL_ROOT;?>/css/bootstrap.min.css"
	      rel="stylesheet">
	<link href="<?php echo URL_ROOT;?>/css/base.css"
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
<body>
<div class="grid-container">
	<header>
		<nav class="navbar navbar-expand-md">
			<div class="container-fluid">
				<a class="navbar-brand border-0 me-auto ms-3 ms-md-5"
				   href="<?php echo URL_ROOT?>"><img alt="Motel X Logo"
                                                          draggable="false"
                                                          height="70"
                                                          id="Mote-X-logo"
                                                          src="<?php echo URL_ROOT;?>/img/gallery/hotel_logo.png"/></a>
				<button class="navbar-toggler me-4"
				        data-bs-target="#navbar"
				        data-bs-toggle="collapse"
				        type="button">
					<i class="fas fa-bars fa-lg"></i>
				</button>
				<div class="collapse navbar-collapse"
				     id="navbar">
					<ul class="navbar-nav ms-auto me-3 me-md-4 me-lg-5 align-items-center">
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="<?php echo URL_ROOT . '/pages/blog'?>"><i class="fa-solid fa-blog pe-2"></i>Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="<?php echo URL_ROOT . '/pages/gallery'?>"><i class="fa-regular fa-images pe-2"></i>Gallery</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="<?php echo URL_ROOT . '/pages/help'?>"><i class="fa-solid fa-circle-info pe-2"></i>Help
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="<?php echo URL_ROOT . '/users/login'?>"><i class="fa-solid fa-right-to-bracket pe-2"></i>Log In</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
