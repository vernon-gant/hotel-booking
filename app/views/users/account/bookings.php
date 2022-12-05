<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
<div class="container py-5">
    <div class="row">
        <div class="col-sm-11 col-md-10 col-lg-9 mx-auto">
            <nav class="navbar navbar-light bg-light">
                <ul class="navbar-nav col-12 d-flex flex-row justify-content-around">
                    <li class="active nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT . "/users/account/profile" ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT . "/users/account/" ?>">Bookings</a>
                    </li>
                </ul>
            </nav>
            <div class="card border-0 shadow-lg rounded-3 text-dark">
				<?php if (!empty($data['bookings'])): ?>
                    <div class="card-body">
                        <table class="table table-striped table-hover align-items-center">
                            <thead>
                            <tr>
                                <th class="text-center">Reservation ID</th>
                                <th class="text-center">Room No.</th>
                                <th class="text-center">Guests</th>
                                <th class="text-center">Arrival</th>
                                <th class="text-center">Departure</th>
                                <th class="text-center">Services</th>
                                <th class="text-center pb-1">Status</th>
                                <th class="text-center">Total paid</th>
                            </tr>
                            </thead>
							<?php foreach ($data['bookings'] as $index => $booking) : ?>
								<?php if ($index == 0)
									echo "<tbody>" ?>
                                <tr>
                                    <td class="text-center"><?php echo $booking['res_id'] ?></td>
                                    <td class="text-center"><?php echo $booking['room_num'] ?></td>
                                    <td class="text-center"><?php echo $booking['guests'] ?></td>
                                    <td class="text-center"><?php echo date_format(date_create($booking['arrival']), "d/m/Y") ?></td>
                                    <td class="text-center"><?php echo date_format(date_create($booking['departure']), "d/m/Y") ?></td>
                                    <td class="text-center"><?php echo $booking['services'] ?></td>
                                    <td class="text-center
                                    <?php echo match ($booking['status']) {
										'new' => "bg-success",
										'confirmed' => "bg-primary",
										'canceled' => "bg-danger"
									}
									?> text-white"><?php echo $booking['status'] ?></td>
                                    <td class="text-center"><?php echo $booking['total_price'] ?>€</td>
                                </tr>
								<?php if ($index == count($data['bookings']) - 1)
									echo "</tbody>" ?>
							<?php endforeach; ?>
                        </table>
                    </div>
				<?php else: ?>
                    <div class="card p-5 text-center">
                        <h3>No bookings yet</h3>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>
