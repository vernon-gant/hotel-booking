<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow-lg rounded-3 text-dark">
                    <div class="card-body p-5 text-center">
                        <form class="mb-md-2 mt-md-4 pb-5 form container-fluid" action="<?php
						echo URL_ROOT . "/bookings/checkout" ?>" method="post">
                            <div class="form-label">
                                <h2 class="fw-bold mb-2 text-uppercase text-center">Check your booking details</h2>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Arrival</p>
                                    <p><?php
										if (!empty($data)) {
											echo date_format($data['booking']['arrival'], "D, d M Y");
										} ?></p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Departure</p>
                                    <p><?php
										echo date_format($data['booking']['departure'], "D, d M Y") ?></p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Guests</p>
                                    <p><?php
										echo $data['booking']['guests'] ?></p>
                                </div>
                            </div>

                            <div class="mx-n5 px-5 py-4">
                                <div class="row">
                                    <div class="col-md-8 col-lg-9 text-start">
                                        <p><?php echo $data['booking']['room_type'] . " for " . $data['booking']['nights'] . " night(s)" ?></p>
                                    </div>
                                    <div class="col-md-4 col-lg-3 text-end">
                                        <p><?php echo $data['booking']['room_cost'] ?>€</p>
                                    </div>
                                </div>
								<?php if (isset($data['booking']['services'])): ?>
                                    <div class="row">
										<?php foreach ($data['booking']['services'] as $name => $price): ?>
                                            <div class="col-md-8 col-lg-9 text-start">
                                                <p class="mb-0 ms-0 fw-bold"><?php echo $name?></p>
                                            </div>
                                            <div class="col-md-4 col-lg-3 text-end">
                                                <p class="mb-0"><?php echo $price?>€</p>
                                            </div>
										<?php endforeach;?>
                                    </div>
								<?php endif; ?>
                            </div>

                            <div class="row my-4">
                                <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-8">
                                    <p class="lead fw-bold mb-0 text-center" style="color: #f37a27;"><?php echo $data['booking']['total_costs']?>€</p>
                                </div>
                            </div>

                            <button class="submit mt-4 btn text-light btn-lg px-5 btn rounded-3 submit"
                                    type="submit" value="continue">Book
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once APPROOT . '/views/includes/footer.php'
?>