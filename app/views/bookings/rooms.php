<?php
require_once APPROOT . '/views/includes/header.php'
?>
<div class="m-0 p-0 w-100 overflow-hidden">
    <div class="d-sm-flex d-md-none">
        <section id="filter-button">
            <button class="btn btn-default" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mobile-filter" aria-expanded="false"
                    aria-controls="mobile-filter">Filters <span class="fa fa-filter
                    pl-1"></span></button>
        </section>
        <section id="mobile-filter">
            <div>
                <h6 class="p-1 border-bottom">Home Furniture</h6>
                <ul>
                    <li><a href="#">Living</a></li>
                    <li><a href="#">Dining</a></li>
                    <li><a href="#">Office</a></li>
                    <li><a href="#">Bedroom</a></li>
                    <li><a href="#">Kitchen</a></li>
                </ul>
            </div>
            <div>
                <h6 class="p-1 border-bottom">Filter By</h6>
                <p class="mb-2">Color</p>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                            <span class="fa fa-circle pr-1" id="red"></span>Red
                        </a></li>
                    <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                            <span class="fa fa-circle pr-1" id="teal"></span>Teal
                        </a></li>
                    <li class="list-group-item list-group-item-action mb-2 rounded"><a href="#">
                            <span class="fa fa-circle pr-1" id="blue"></span>Blue
                        </a></li>
                </ul>
            </div>
            <div>
                <h6>Type</h6>
                <form class="ml-md-2">
                    <div class="form-inline border rounded p-sm-2 my-2">
                        <input type="radio" name="type" id="boring">
                        <label for="boring" class="pl-1 pt-sm-0 pt-1">Boring</label>
                    </div>
                    <div class="form-inline border rounded p-sm-2 my-2">
                        <input type="radio" name="type" id="ugly">
                        <label for="ugly" class="pl-1 pt-sm-0 pt-1">Ugly</label>
                    </div>
                    <div class="form-inline border rounded p-md-2 p-sm-1">
                        <input type="radio" name="type" id="notugly">
                        <label for="notugly" class="pl-1 pt-sm-0 pt-1">Not Ugly</label>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div class="row overflow-hidden">
        <div class="row my-5">
            <div class="col-8 px-0 shadow mx-auto rounded-pill d-none d-md-block">
                <form method="get" action="<?php echo URL_ROOT ?>/bookings" class="shadow
                rounded-pill px-0 overflow-hidden row mx-0">
                    <div class="col-9 overflow-hidden px-0">
                        <div class="px-2 mx-0 row">
                            <div class="col-9 d-flex flex-row px-0">
                                <div class="col-5 form-floating position-relative">
                                    <input required
                                           class="form-control border-0 <?php
										   echo (!empty($data['arrival_err'])) ? 'is-invalid' : '' ?>"
                                           id="arrival"
                                           name="arrival"
                                           value="<?php
										   if (empty($data['arrival_err']) and empty($data['departure_err']))
											   echo $data['arrival'] ?>"
                                           type="date">
                                    <label class="form-label"
                                           for="arrival">Arrival</label>
                                    <span class="invalid-feedback"><?php
										if (!empty($data['arrival_err']))
											echo $data['arrival_err'] ?></span>
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-arrow-right fa-lg"></i>
                                </div>
                                <div class="col-5 form-floating">
                                    <input required class="form-control border-0 <?php
									echo (!empty($data['departure_err'])) ? 'is-invalid' : '' ?>"
                                           id="departure"
                                           name="departure"
                                           value="<?php
										   if (empty($data['departure_err']) and empty($data['arrival_err']))
											   echo $data['departure'] ?>"
                                           type="date">
                                    <label class="form-label"
                                           for="departure">Departure</label>
                                    <span class="invalid-feedback"><?php
										if (!empty($data['departure_err']))
											echo $data['departure_err'] ?></span>
                                </div>
                            </div>
                            <div class="col-3 d-flex justify-content-center align-items-center
                            px-0">
                                <div class="input-group row m-0 align-self-center">
                                    <select class="col-auto w-100 rounded-2 h-50 p-0"
                                            id="guests"
                                            name="guests"
                                            required>
										<?php
										for ($i = 1; $i < 7; $i++) : ?>
                                            <option class="text-center" value="<?php
											echo $i; ?>" <?php
											echo ($i == $data['guests']) ? ' selected' : ''; ?>>
												<?php
												echo $i . " guests"; ?>
                                            </option>
										<?php
										endfor ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 overflow-hidden px-0 d-flex justify-content-center
                    align-items-center" style="background-color: var(--link-color)">
                        <button type="submit" class="border-0 bg-transparent">
                            <span class="link-dark fw-bold">Search</span>
                            <i class="fa-solid fa-arrow-right ms-1 ms-lg-3"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-10 mx-auto row">
            <form id="filter_dashboard" class="d-sm-none d-md-flex col-3" action="<?php echo URL_ROOT ?>/bookings/filter" method="get">
                <div class="container-fluid d-flex flex-column mt-5">
                    <div class="mb-3 border-bottom border-3">
                        <h5>Filter By</h5>
                    </div>
                    <div class="mb-3 border-bottom border-3">
                        <h6 class="mb-2">Floor</h6>
                        <fieldset class="ml-md-2">
                            <div class="form-inline border rounded p-sm-2 my-2">
                                <input type="radio" name="floor" id="1" value="1"
									<?php
									if (isset($data['pets']) and (int)$data['floor'] == 1)
										echo "checked"
									?>
                                >
                                <label for="1" class="pl-1 pt-sm-0 pt-1">1</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="2" value="2"
									<?php
									if (isset($data['pets']) and (int)$data['floor'] == 2)
										echo "checked"
									?>
                                >
                                <label for="2" class="pl-1 pt-sm-0 pt-1">2</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="3" value="3"
									<?php
									if (isset($data['pets']) and (int)$data['floor'] == 3)
										echo "checked"
									?>
                                >
                                <label for="3" class="pl-1 pt-sm-0 pt-1">3</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="4" value="4"
									<?php
									if (isset($data['pets']) and (int)$data['floor'] == 4)
										echo "checked"
									?>
                                >
                                <label for="4" class="pl-1 pt-sm-0 pt-1">4</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="5" value="5"
									<?php
									if (isset($data['pets']) and (int)$data['floor'] == 5)
										echo "checked"
									?>
                                >
                                <label for="5" class="pl-1 pt-sm-0 pt-1">5</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="mb-3 border-bottom border-3">
                        <h6 class="mb-2">Pets allowed</h6>
                        <fieldset class="ml-md-2">
                            <div class="form-inline border rounded p-sm-2 my-2">
                                <input type="radio" name="pets" id="yes" value="1"
									<?php
									if (isset($data['pets']) and (int)$data['pets'] == 1)
										echo "checked"
									?>
                                >
                                <label for="yes" class="pl-1 pt-sm-0 pt-1">Yes</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="pets" id="no" value="0"
									<?php
									if (isset($data['pets']) and (int)$data['pets'] == 0)
										echo "checked"
									?>
                                >
                                <label for="no" class="pl-1 pt-sm-0 pt-1">No</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="mb-3 border-bottom border-3">
                        <h6 class="mb-2">Price</h6>
                        <fieldset class="ml-md-2">
                            <div class="form-inline border rounded p-sm-2 my-2">
                                <input type="radio" name="price" id="1" value="0-100"
									<?php
									if (isset($data['price']) and implode("-", $data['price']) == "0-100")
										echo "checked"
									?>
                                >
                                <label for="1" class="pl-1 pt-sm-0 pt-1">< 100</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="price" id="2" value="100-200"
									<?php
									if (isset($data['price']) and implode("-", $data['price']) == "100-200")
										echo "checked"
									?>
                                >
                                <label for="2" class="pl-1 pt-sm-0 pt-1">100 - 200</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="price" id="3" value="200-300"
									<?php
									if (isset($data['price']) and implode("-", $data['price']) == "200-300")
										echo "checked"
									?>
                                >
                                <label for="3" class="pl-1 pt-sm-0 pt-1">200 - 300</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="price" id="4" value="300-400"
									<?php
									if (isset($data['price']) and implode("-", $data['price']) == "300-400")
										echo "checked"
									?>
                                >
                                <label for="4" class="pl-1 pt-sm-0 pt-1">300 - 400</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="price" id="5" value="400-1000"
									<?php
									if (isset($data['price']) and implode("-", $data['price']) == "400-1000")
										echo "checked"
									?>
                                >
                                <label for="5" class="pl-1 pt-sm-0 pt-1">400+</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="d-none">
                        <input name="arrival" type="date" value="<?php
						echo $data['arrival'] ?>">
                        <input name="departure" type="date" value="<?php
						echo $data['departure'] ?>">
                        <input name="guests" type="number" value="<?php
						echo $data['guests'] ?>">
                        <input name="nights" type="number" value="<?php
						echo $data['nights'] ?>">
                    </div>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </form>
            <section id="rooms" class="col-9">
				<?php
				if (empty($data['arrival_err']) and empty($data['departure_err']) and $data['rooms'] != null): ?>
                    <h2 class="ms-5 mb-3"><?php
						echo count($data['rooms']) ?> Rooms found</h2>
                    <div class="container my-5">
                        <form action="<?php echo URL_ROOT ?>/bookings/guest" method="get" class="overflow-hidden">
                            <div class="d-flex flex-column align-items-center">
                                <table class="table table-bordered table-responsive">
                                    <thead class="align-middle">
                                    <tr>
                                        <th scope="col">Room Category</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price for <?php
											echo $data['nights'] ?> nights
                                        </th>
                                        <th scope="col">Add ons</th>
                                        <th scope="col">Choose</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php
									foreach ($data['rooms'] as $room) : ?>
                                        <tr>
                                            <td>
                                                <div>
													<?php
													echo $room['room_type'] ?>
                                                    <img src="<?php
													echo mapRoomToPhoto($room['room_type']) ?>"
                                                         class="fit-cover img-fluid" alt="room photo">
													<?php
													echo $room['description'] ?>
                                                </div>
                                            </td>
                                            <td>
												<?php
												for ($i = 0; $i < $data['guests']; $i++) : ?>
                                                    <i class="fa-regular fa-user"></i>
												<?php
												endfor ?>
                                            </td>
                                            <td>
												<?php echo $room['cost'] ?>
                                            </td>
                                            <td class="d-flex flex-column justify-content-start">
                                                <div class="form-check border-0">
                                                    <input class="form-check-input" name="services<?php
													echo str_replace(" ", "", $room['room_type']) ?>[]" type="checkbox" value="breakfast" id="breakfast">
                                                    <label class="form-check-label" for="breakfast">Breakfast</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="services<?php
													echo str_replace(" ", "", $room['room_type']) ?>[]" type="checkbox" value="parking" id="parking">
                                                    <label class="form-check-label" for="parking">Parking</label>
                                                </div>
												<?php
												if ($room['pets_allowed'] == 1): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="services<?php
														echo str_replace(" ", "", $room['room_type']) ?>[]" type="checkbox" value="pets" id="pets">
                                                        <label class="form-check-label" for="pets">Pets</label>
                                                    </div>
												<?php
												endif ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center form-check">
                                                    <input required class="form-check-input" type="radio" name="room_type" value="<?php
													echo str_replace(" ", "", $room['room_type']) ?>">
                                                    <input name="cost<?php echo str_replace(" ", "", $room['room_type']) ?>" class="d-none" type="number" value="<?php echo $room['cost'] ?>">
                                                </div>
                                            </td>
                                        </tr>
									<?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="d-none">
                                    <input name="arrival" type="date" value="<?php
									echo $data['arrival'] ?>">
                                    <input name="departure" type="date" value="<?php
									echo $data['departure'] ?>">
                                    <input name="guests" type="number" value="<?php
									echo $data['guests'] ?>">
                                    <input name="nights" type="number" value="<?php
									echo $data['nights'] ?>">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-success position-sticky" type="submit">Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
				<?php
				else: ?>
                    <div class="text-center mx-auto">
                        <h2>Nothing Found...</h2>
                    </div>
				<?php
				endif ?>
            </section>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php' ?>
