<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
$booking = $data['booking'] ?? null;
?>
<div class="container-fluid h-100">

    <div class="container h-100 d-flex flex-column justify-content-center">
        <!-- Title -->
        <div class="d-flex justify-content-center align-items-center py-3 mb-5">
            <h2 class="h5 mb-0">Booking #<?php echo $booking->res_id ?></h2>
        </div>

        <!-- Main content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <span class="me-3">Booking date: <?php echo date_format(date_create($booking->transaction_date), "d-m-Y") ?></span>
                            <span class="me-3"><?php echo $booking->user_email ?></span>
                            <span class="me-3"><?php echo $booking->status ?></span>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex mb-2">
                                        <div class="flex-lg-grow-1 ms-3">
                                            <h6 class="small mb-0 lh-base"><a href="#" class="text-reset">
													<?php
													echo $booking->name . " (room " . $booking->room_num . " on the " . $booking->floor . "st/nd/rd/th floor) for " . $booking->nights . " nights from " .
														date_format(date_create($booking->arrival), "d-m-Y") . " till " . date_format(date_create($booking->departure), "d-m-Y") .
														" for " . $booking->guests . " guest(s)" ?></a></h6>
                                            <span class="small mt-3"><span class="fw-bold">Services:</span> <?php echo $booking->services ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end"><?php echo $booking->room_price ?>€</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">Services</td>
                                <td class="text-end"><?php echo $booking->total_price - $booking->room_price ?>€</td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="2">TOTAL</td>
                                <td class="text-end"><?php echo $booking->total_price ?></td>
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
                        <h3 class="h6">Guest Information</h3>
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
