<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
    <div class="container h-100 py-5">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title mb-5">
                    <h2 class="fw-bold text-center">Bookings Management</h2>
                </div>
                <table class="table table-striped table-hover align-items-center">
                    <thead>
                    <tr>
                        <th class="text-center">Reservation ID</th>
                        <th class="text-center">User Email</th>
                        <th class="text-center">Room</th>
                        <th class="text-center">Guests</th>
                        <th class="text-center">Arrival</th>
                        <th class="text-center">Departure</th>
                        <th class="text-center">Services</th>
                        <th class="text-center pb-1">
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                    Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo URL_ROOT . '/admin/bookings/filter/new' ?>">new</a></li>
                                    <li><a class="dropdown-item" href="<?php echo URL_ROOT . '/admin/bookings/filter/confirmed' ?>">confirmed</a></li>
                                    <li><a class="dropdown-item" href="<?php echo URL_ROOT . '/admin/bookings/filter/canceled' ?>">canceled</a></li>
                                    <li><a class="dropdown-item" href="<?php echo URL_ROOT . '/admin/bookings' ?>">all</a></li>
                                </ul>
                            </div>
                        </th>
                        <th class="text-center">Total paid</th>
                        <th class="text-center">Show</th>
                    </tr>
                    </thead>
					<?php if (isset($data['bookings'])) : ?>
						<?php foreach ($data['bookings'] as $index => $booking) : ?>
							<?php if ($index == 0)
								echo "<tbody>" ?>
                            <tr>
                                <td class="text-center"><?php echo $booking['res_id'] ?></td>
                                <td class="text-center"><?php echo $booking['user_email'] ?></td>
                                <td class="text-center"><?php echo $booking['room_num'] ?></td>
                                <td class="text-center"><?php echo $booking['guests'] ?></td>
                                <td class="text-center"><?php echo date_format(date_create($booking['arrival']), "d/m/Y") ?></td>
                                <td class="text-center"><?php echo date_format(date_create($booking['departure']), "d/m/Y") ?></td>
                                <td class="text-center"><?php echo $booking['services'] ?></td>
                                <td class="text-center">
                                    <form action="<?php echo URL_ROOT . '/admin/bookings/update/' . $booking['res_id'] ?>" method="post">
                                        <select onchange="this.form.submit()" name="status">
                                            <option <?php if ($booking['status'] == 'new')
												echo "readonly disabled selected" ?> value="new">new
                                            </option>
                                            <option <?php if ($booking['status'] == 'confirmed')
												echo "readonly disabled selected" ?> value="confirmed">confirmed
                                            </option>
                                            <option <?php if ($booking['status'] == 'canceled')
												echo "readonly disabled selected" ?> value="canceled">canceled
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center"><?php echo $booking['total_price'] ?>€</td>
                                <td class="text-center">
                                    <a href="<?php echo URL_ROOT . '/admin/bookings/show/' . $booking['res_id'] ?>">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
							<?php if ($index == count($data['bookings']) - 1)
								echo "</tbody>" ?>
						<?php endforeach; ?>
					<?php else: ?>
                        <h2>No bookings found...</h2>
					<?php endif ?>
                </table>
            </div>
        </div>
    </div>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>