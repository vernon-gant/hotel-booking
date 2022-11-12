<?php
require_once APPROOT . '/views/includes/header.php'
?>
<div class="container py-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow-lg rounded-3 text-dark">
                <div class="card-body p-5 text-center">
                    <form class="mb-md-2 mt-md-4 pb-5 form" action="<?php echo URL_ROOT . "/bookings/guest"?>" method="post">
                        <div class="form-label">
                            <h2 class="fw-bold mb-2 text-uppercase text-center">Tell us about yourself</h2>
                            <p class="text-dark-50 mt-3 mb-5">Please, fill out this guest form to complete your booking</p>
                        </div>

                        <div class="container-fluid">
                            <div class="form-outline form-white form-floating mb-4">
                                <input type="text"
                                       id="first_name"
                                       class="form-control <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : ''?>"
                                       name="first_name"
                                       required
                                       value="<?php echo $data['first_name']?>"/>
                                <label class="form-label"
                                       for="first_name">First name <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['fname_err']?></span>
                            </div>

                            <div class="form-outline form-white form-floating mb-4">
                                <input type="text"
                                       id="last_name"
                                       class="form-control <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['last_name']?>"
                                       name="last_name"
                                       required/>
                                <label class="form-label"
                                       for="last_name">Last name <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['lname_err']?></span>
                            </div>

                            <div class="form-outline form-white form-floating mb-4">
                                <input type="text"
                                       id="address"
                                       class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['address']?>"
                                       required
                                       name="address"/>
                                <label class="form-label"
                                       for="address">Address <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['address_err']?></span>
                            </div>

                            <div class="form-outline form-white form-floating mb-4">
                                <input type="text"
                                       id="city"
                                       class="form-control <?php echo (!empty($data['city_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['city']?>"
                                       required
                                       name="city"/>
                                <label class="form-label"
                                       for="city">City <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['city_err']?></span>
                            </div>

                            <div class="form-outline form-white mb-5 form-floating">
                                <input type="text"
                                       id="country"
                                       class="form-control <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['country']?>"
                                       required
                                       name="country">
                                <label class="form-label"
                                       for="country">Country <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['country_err']?></span>
                            </div>

                            <div class="form-outline form-white form-floating mb-4">
                                <input type="text"
                                       id="zip"
                                       class="form-control <?php echo (!empty($data['zip_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['zip']?>"
                                       required
                                       name="zip"/>
                                <label class="form-label"
                                       for="zip">Post code <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['zip_err']?></span>
                            </div>

                            <div class="form-outline form-white form-floating mb-4">
                                <input type="date"
                                       id="dob"
                                       class="form-control <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['dob']?>"
                                       required
                                       name="dob"/>
                                <label class="form-label"
                                       for="dob">Date of birthday <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['dob_err']?></span>
                            </div>

                            <div class="form-outline form-white mb-5 form-floating">
                                <input type="tel"
                                       id="phone"
                                       class="form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''?>"
                                       value="<?php echo $data['phone']?>"
                                       required
                                       name="phone">
                                <label class="form-label"
                                       for="phone">Phone <sup class="fs-6 text-danger">*</sup></label>
                                <span class="invalid-feedback"><?php echo $data['country_err']?></span>
                            </div>
                        </div>

                        <button class="submit mt-4 btn text-light btn-lg px-5 btn rounded-3 submit"
                                type="submit" value="login">Continue
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
