<?php
require_once APPROOT . '/views/includes/head.php';
?>
<body>
	<main>
        <div class="container py-5" id="content">
            <div class="row">
                <div class="col-9 col-md-7 col-lg-5 mx-auto">
                    <?php flash('admin_login_needed'); ?>
                    <div class="card border-0 shadow-lg rounded-3 text-dark">
                        <div class="card-body p-5 text-center">
                            <form class="mb-md-2 mt-md-4 pb-5" method="post" action="<?php echo URL_ROOT . '/admin/login' ?>">
                                <h2 class="fw-bold mb-2 text-uppercase text-center">Login</h2>
                                <p class="text-dark-50 mt-3 mb-5">Please, enter your login and
                                    password</p>

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

                                <div class="form-outline form-white mb-5 form-floating">
                                    <input type="password"
                                           id="password"
                                           class="form-control <?php echo (!empty($data['pass_err'])) ? 'is-invalid' : '' ?>"
                                           name="pass"/>
                                    <label class="form-label"
                                           for="password">Password</label>
                                    <span class="invalid-feedback"><?php echo $data['pass_err'] ?></span>
                                </div>

                                <button class="btn text-light btn-lg px-5 btn rounded-3 submit"
                                        type="submit" value="login">Login
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>
