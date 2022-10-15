<!DOCTYPE html>
<html lang="en">
<head>
	<!--Required meta tags-->
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0"
	      name="viewport">
	<!--Pass title variable according to website content-->
	<title><?php if (isset($title)) {
			echo $title;
		} ?>
	</title>
	<!--Required links to css, bootstrap and fontaweasome -->
	<link href="../styles/css/bootstrap.min.css"
	      rel="stylesheet">
	<link href="../styles/css/base.css"
	      rel="stylesheet">
	<link href="https://fonts.googleapis.com"
	      rel="preconnect">
	<link crossorigin
	      href="https://fonts.gstatic.com"
	      rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500;600;700&display=swap"
	      rel="stylesheet">
	<link crossorigin="anonymous"
	      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
	      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
	      referrerpolicy="no-referrer"
	      rel="stylesheet"/>
	<script crossorigin="anonymous"
	        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
	        referrerpolicy="no-referrer"
	        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</head>
<body>
<div class="grid-container">
	<header>
		<nav class="navbar navbar-expand-md">
			<div class="container-fluid">
				<a class="navbar-brand border-0 me-auto ms-3 ms-md-5"
				   href="../index.php"><img alt="Motel X Logo"
				                            draggable="false"
				                            height="70"
				                            id="Mote-X-logo"
				                            src="/resources/img/gallery/hotel_logo.png"/></a>
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
							   href="/view/blog.php"><i class="fa-solid fa-blog pe-2"></i>Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="/view/gallery.php"><i class="fa-regular fa-images pe-2"></i>Gallery</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="/view/help.php"><i class="fa-solid fa-circle-info pe-2"></i>Help
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link mx-2"
							   href="/view/login.php"><i class="fa-solid fa-right-to-bracket pe-2"></i>Log In</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
