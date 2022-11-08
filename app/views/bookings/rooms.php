<?php
require_once APPROOT . '/views/includes/header.php'
?>
<div class="m-0 p-0 w-100">
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
    <div class="row">
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
                                            <option class="text-center"
                                                    value="<?php echo $i; ?>"
												<?php
												echo ($i == $data['guests']) ? ' selected' : ''; ?>><?php
												echo $i . " guests";
                                                ?>
                                            </option>
										<?php
										endfor ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 overflow-hidden px-0 d-flex justify-content-center
                    align-items-center"
                         style="background-color: var(--link-color)">
                        <button type="submit">
                            <span>Book Now</span>
                            <i class="fa-solid fa-arrow-right ms-1 ms-lg-3"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="row-cols-3 mx-auto d-flex justify-content-center d-md-none">
                <button class="btn btn-primary btn-success"> Book Now</button>
            </div>
        </div>
        <div class="col-9 mx-auto row">
            <form id="filter_dashboard" class="d-sm-none d-md-flex col-3" action="<?php
			echo
			URL_ROOT ?>/bookings/filter" method="get">
                <div class="container-fluid d-flex flex-column mt-5">
                    <div class="mb-3 border-bottom border-3">
                        <h5>Filter By</h5>
                    </div>
                    <div class="mb-3 border-bottom border-3">
                        <h6 class="mb-2">Floor</h6>
                        <fieldset class="ml-md-2">
                            <div class="form-inline border rounded p-sm-2 my-2">
                                <input type="radio" name="floor" id="1" value="1">
                                <label for="1" class="pl-1 pt-sm-0 pt-1">1</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="2" value="2">
                                <label for="2" class="pl-1 pt-sm-0 pt-1">2</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="3" value="3">
                                <label for="3" class="pl-1 pt-sm-0 pt-1">3</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="4" value="4">
                                <label for="4" class="pl-1 pt-sm-0 pt-1">4</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="floor" id="5" value="5">
                                <label for="5" class="pl-1 pt-sm-0 pt-1">5</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="mb-3 border-bottom border-3">
                        <h6 class="mb-2">Pets allowed</h6>
                        <fieldset class="ml-md-2">
                            <div class="form-inline border rounded p-sm-2 my-2">
                                <input type="radio" name="pets" id="yes" value="yes">
                                <label for="yes" class="pl-1 pt-sm-0 pt-1">Yes</label>
                            </div>
                            <div class="form-inline border rounded p-md-2 p-sm-1 mb-2">
                                <input type="radio" name="pets" id="no" value="no">
                                <label for="no" class="pl-1 pt-sm-0 pt-1">No</label>
                            </div>
                        </fieldset>
                    </div>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </form>
            <section id="rooms" class="col-9">
                <h2><?php echo count($data['rooms'])?> Rooms found</h2>
                <div class="container">
                    <div class="row">
						<?php foreach ($data['rooms'] as $room) : ?>
                            <div class="m-2">
                                <h2><?php echo $room['room_type']?></h2>
                                <p><?php echo $room['description']?></p>
                                <span><?php echo $room['price']?></span>
                                <img src="<?php echo mapRoomToPhoto($room['room_type'])?>"
                                    class="fit-cover img-fluid">
                            </div>
						<?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/963486/pexels-photo-963486.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Wooden chair with legs</p>
                                    <p>$90</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 offset-lg-0 col-sm-4 offset-sm-2 col-11 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/1125137/pexels-photo-1125137.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Ugly chair and table set</p>
                                    <p>$100</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/3757055/pexels-photo-3757055.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Leather Lounger</p>
                                    <p>$950</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 offset-lg-0 offset-sm-2 col-11 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.unsplash.com/photo-1537182534312-f945134cce34?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Tree Trunk table set</p>
                                    <p>$390</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/3230274/pexels-photo-3230274.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Red Leather Bar Stool</p>
                                    <p>$30</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 offset-lg-0 offset-sm-2 col-11 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/3773571/pexels-photo-3773571.png?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Modern Dining Table</p>
                                    <p>$740</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/534172/pexels-photo-534172.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Boring Dining Table</p>
                                    <p>$760</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 offset-lg-0 offset-sm-2 col-11 offset-1">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://images.pexels.com/photos/37347/office-sitting-room-executive-sitting.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">An Ugly Office</p>
                                    <p>$90</p>
                                    <span class="fa fa-circle" id="red"></span>
                                    <span class="fa fa-circle" id="teal"></span>
                                    <span class="fa fa-circle" id="blue"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php' ?>
