<?php
	$title = "Gallery";
	require_once '../includes/header.php'
?>
	<div id="introCarousel"
	     class="carousel slide carousel-fade shadow-sm"
	     data-bs-interval="false"
	     data-bs-ride="carousel">
		<ol class="carousel-indicators">
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="0"
			    class="active"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="1"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="2"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="3"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="4"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="5"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="6"></li>
			<li data-bs-target="#introCarousel"
			    data-bs-slide-to="7"></li>
		</ol>
		<!--Inner-->
		<div class="carousel-inner">
			<!-- Single Item -->
			<div class="carousel-item active"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!-- Single Item -->
			<div class="carousel-item"></div>

			<!--Controls-->
			<a class="carousel-control-prev"
			   href="#introCarousel"
			   role="button"
			   data-bs-slide="prev">
				<span class="carousel-control-prev-icon"
				      aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next"
			   href="#introCarousel"
			   role="button"
			   data-bs-slide="next">
				<span class="carousel-control-next-icon"
				      aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
<?php require_once '../includes/footer.php' ?>