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
                            <th class="text-center">Status</th>
                            <th class="text-center">Total paid</th>
                            <th class="text-center">Show</th>
					    </tr>
					</thead>
					<?php if(isset($data['bookings'])) : ?>
						<?php foreach ($data['bookings'] as $index => $booking) : ?>
							<?php if ($index == 0) echo "<tbody>"?>
							<tr>
                                <td class="text-center"><?php echo $booking['res_id']?></td>
								<td class="text-center"><?php echo $booking['user_email']?></td>
                                <td class="text-center"><?php echo $booking['room_num']?></td>
                                <td class="text-center"><?php echo $booking['guests']?></td>
								<td class="text-center"><?php echo date_format(date_create($booking['arrival']),"d/m/Y")?></td>
                                <td class="text-center"><?php echo date_format(date_create($booking['departure']),"d/m/Y")?></td>
                                <td class="text-center"><?php echo $booking['services']?></td>
                                <td class="text-center"><?php echo $booking['status']?></td>
								<td class="text-center"><?php echo $booking['total_price']?>€</td>
                                <td class="text-center">
                                    <a href="<?php echo URL_ROOT . '/admin/bookings/show/' . $booking['res_id']?>">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
							</tr>
							<?php if ($index == count($data['bookings']) - 1) echo "</tbody>"?>
						<?php endforeach;?>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>