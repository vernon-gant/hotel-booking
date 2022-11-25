<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
<div class="container py-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <nav class="navbar navbar-light bg-light">
                <ul class="navbar-nav col-12 d-flex flex-row justify-content-around">
                    <li class="active nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT . "/users/account/profile" ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT . "/users/account/bookings" ?>">Bookings</a>
                    </li>
                </ul>
            </nav>
            <div class="card border-0 shadow-lg rounded-3 text-dark">
                <div class="card-body p-5 text-center">
                    <form class="mb-md-2 mt-md-4 pb-5 form" action="<?php echo URL_ROOT . "/users/account/profile"?>" method="post">
                        <div class="form-label">
                            <h2 class="fw-bold mb-3 text-uppercase text-center">Profile</h2>
							<?php flash("user_change_success")?>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="text"
                                   id="first_name"
                                   class="form-control <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '' ?>"
                                   name="first_name"
                                   value="<?php echo $data['first_name'] ?>"/>
                            <label class="form-label"
                                   for="first_name">First name</label>
                            <span class="invalid-feedback"><?php echo $data['fname_err'] ?></span>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="text"
                                   id="last_name"
                                   class="form-control <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '' ?>"
                                   value="<?php echo $data['last_name'] ?>"
                                   name="last_name"/>
                            <label class="form-label"
                                   for="last_name">Last name</label>
                            <span class="invalid-feedback"><?php echo $data['lname_err'] ?></span>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="email"
                                   id="email"
                                   class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>"
                                   value="<?php echo $data['email'] ?>"
                                   name="email"/>
                            <label class="form-label"
                                   for="email">Email</label>
                            <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
                        </div>

                        <div class="form-outline form-white mb-4 form-floating">
                            <input type="password"
                                   id="old_pass"
                                   class="form-control <?php echo (!empty($data['old_pass_err'])) ? 'is-invalid' : '' ?>"
                                   name="old_pass">
                            <label class="form-label"
                                   for="old_pass">Old password</label>
                            <span class="invalid-feedback"><?php echo $data['old_pass_err'] ?></span>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="password"
                                   id="pass"
                                   class="form-control <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>"
                                   name="pass"/>
                            <label class="form-label"
                                   for="pass">New password</label>
                            <span class="invalid-feedback"><?php echo $data['pass_err'] ?></span>
                        </div>

                        <div class="form-outline form-white mb-5 form-floating">
                            <input type="password"
                                   id="pass_repeat"
                                   class="form-control <?php echo (!empty($data['pass_repeat_err'])) ? 'is-invalid' : '' ?>"
                                   name="pass_repeat">
                            <label class="form-label"
                                   for="pass_repeat">Repeat new password</label>
                            <span class="invalid-feedback"><?php echo $data['pass_repeat_err'] ?></span>
                        </div>

                        <button class="submit btn text-light btn-lg px-5 btn rounded-3 submit"
                                type="submit" value="login">Sign Up
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>
