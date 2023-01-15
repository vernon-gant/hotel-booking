<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
	<article class="container-fluid px-lg-5 mt-3">
		<h1 class="text-center my-5">Impressum</h1>
		<section class="container-fluid d-flex flex-column align-items-start">
			<div class="row d-inline-block my-1 py-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Company name</span>
					<span class="fw-normal px-3 py-2">Motel X</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Headoffice</span>
					<div class="d-flex flex-column justify-content-center py-2">
						<span class="px-3 py-1">Email: x@motel.co</span>
						<span class="px-3 pb-1">Tel: +43 677 62805391</span>
						<address class="m-0 px-3">
							Höchstädtplatz 6
							<br>
							1200 Wien
							<br>
						</address>
					</div>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Legal form</span>
					<span class="fw-normal px-3 py-2">Limited liability company</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class=" fw-bold">Company registration number</span>
					<span class="fw-normal px-3 py-2">FN123456k</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Company registration court</span>
					<span class="fw-normal px-3 py-2">Commercial Court Vienna</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">VAT number</span>
					<span class="fw-normal px-3 py-2">ATU99999999</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Managing Director</span>
					<span class="fw-normal px-3 py-2">Aldin Zehinovic</span>
				</div>
			</div>
			<div class="row my-1 py-lg-1 w-50">
				<div class="d-flex flex-column my-1 align-items-start container">
					<div class="fw-bold mb-3">Shares in the company</div>
					<div class="row">
						<div class="col-4 d-flex flex-column justify-content-center">
							<img alt="Photo of Aldin"
							     class="img-fluid rounded team"
							     src="<?php echo URL_ROOT?>/img/team/aldin.jpeg">
							<span class="w-auto my-1 text-center">Aldin Zehinovic (50%)</span>
						</div>
						<div class="col-4 d-flex flex-column justify-content-center">
							<img alt="Photo of Aleks"
							     class="img-fluid rounded team"
							     src="<?php echo URL_ROOT?>/img/team/aleks-photo.jpg">
							<span class="w-auto my-1 text-center">Aleksandr Zakharov (50%)</span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>
<?php require_once APPROOT . '/views/includes/footer.php' ?>