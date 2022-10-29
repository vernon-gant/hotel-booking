<?php
    require_once APPROOT . '/views/includes/header.php'
?>
	<article class="container-fluid px-lg-5 mt-3">
		<h1 class="text-center my-5">Impressum</h1>
		<section class="container-fluid d-flex flex-column align-items-start">
			<div class="row d-inline-block my-1 py-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Firmenname</span>
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
					<span class="fw-bold">Rechtsform</span>
					<span class="fw-normal px-3 py-2">Gesellschaft mit beschränkter Haftung</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class=" fw-bold">Firmenbuchnummer</span>
					<span class="fw-normal px-3 py-2">FN123456k</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Firmenbuchgericht</span>
					<span class="fw-normal px-3 py-2">Handelsgericht Wien</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">UID-Nummer</span>
					<span class="fw-normal px-3 py-2">ATU99999999</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1">
				<div class="d-flex flex-column my-1">
					<span class="fw-bold">Geschäftsführer</span>
					<span class="fw-normal px-3 py-2">Aldin Zehinovic</span>
				</div>
			</div>
			<div class="row d-inline-block my-1 py-lg-1 w-50">
				<div class="d-flex flex-column my-1 align-items-start">
					<span class="fw-bold">Gesellschaftsanteile</span>
					<div class="d-flex flex-row p-3 flex-lg-shrink-0">
						<div class="d-flex flex-column align-items-center p-1">
							<img alt="Photo of Aldin"
							     class="img-fluid rounded"
							     src="<?php echo URL_ROOT?>/img/team/aleks-photo.jpg">
							<span class="w-auto my-1 text-center">Aldin Zehinovic (50%)</span>
						</div>
						<div class="d-flex flex-column align-items-center p-1 mx-5">
							<img alt="Photo of Aleks"
							     class="img-fluid rounded"
							     src="<?php echo URL_ROOT?>/img/team/aleks-photo.jpg">
							<span class="w-auto my-1 text-center">Aleksandr Zakharov (50%)</span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>
<?php require_once APPROOT . '/views/includes/footer.php' ?>