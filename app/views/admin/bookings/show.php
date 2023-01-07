<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
$booking = $data['booking'] ?? null;
?>
<div class="container-fluid h-100">

    <div class="container h-100 d-flex flex-column justify-content-center">
        <!-- Title -->
        <div class="d-flex justify-content-center align-items-center py-3 mb-5">
            <h2 class="h3 mb-0">Booking #<?php echo $booking->res_id ?></h2>
        </div>

        <!-- Main content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <span class="ms-2 me-2">Booking date: <?php echo date_format(date_create($booking->transaction_date), "d-m-Y") ?></span>
                            <span class="me-3 fst-italic"><?php echo $booking->user_email ?></span>
                            <span class="me-2 p-2 rounded text-white
                            <?php
							echo match ($booking->status) {
								'new' => 'bg-primary',
								'confirmed' => 'bg-success',
								'canceled' => 'bg-danger',
							};
							?>"><?php echo $booking->status ?></span>
                        </div>
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr class="w-100">
                                <td colspan="6" class="pe-0">
                                    <div class="d-flex mb-2 w-75">
                                        <div class="flex-lg-grow-1">
                                            <h6 class="small mb-0 lh-base"><a href="#" class="text-reset">
													<?php
													echo $booking->name . " (room " . $booking->room_num . " on the " . $booking->floor . "st/nd/rd/th floor) for " . $booking->nights . " nights from " .
														date_format(date_create($booking->arrival), "d-m-Y") . " till " . date_format(date_create($booking->departure), "d-m-Y") .
														" for " . $booking->guests . " guest(s)" ?></a></h6>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="6" class="text-end ms-5 ps-0">
                                    <div>
										<?php echo $booking->room_price ?>€
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="10"><span class="fw-bold me-1">Services:</span><?php echo $booking->services ?></td>
                                <td colspan="2" class="text-end"><?php echo $booking->total_price - $booking->room_price ?>€</td>
                            </tr>
                            <tr class="fw-bold">
                                <td class="text-decoration-underline mt-3" colspan="10">TOTAL</td>
                                <td colspan="1" class="text-end"><?php echo $booking->total_price ?>€</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <!-- Shipping information -->
                    <div class="card-body">
                        <h3 class="h5">Guest Information</h3>
                        <hr>
                        <address>
                            <span class="fw-bold"><?php echo $booking->first_name . " " . $booking->last_name ?></span><br>
                            <span><?php echo $booking->address ?></span><br>
                            <span><?php echo $booking->city ?></span><br>
                            <span><?php echo $booking->phone ?></span>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
