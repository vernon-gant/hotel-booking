<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
$user = $data['user'] ?? null;
?>
    <?php if (isset($user)) : ?>
    <div class="container py-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow-lg rounded-3 text-dark">
                <div class="card-body p-5 text-center">
                    <form class="mb-md-2 mt-md-4 pb-5 form" action="<?php echo URL_ROOT . "/admin/users/edit/" . $user->email?>" method="post">
                        <?php flash("incorrect_email")?>
                        <div class="form-label">
                            <h3 class="fw-bold mb-4 text-uppercase text-center"><?php echo $user->email?></h3>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="text"
                                   id="first_name"
                                   class="form-control"
                                   name="first_name"
                                   value="<?php echo $user->first_name?>">
                            <label class="form-label"
                                   for="first_name">First name</label>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="text"
                                   id="last_name"
                                   class="form-control"
                                   value="<?php echo $user->last_name?>"
                                   name="last_name"/>
                            <label class="form-label"
                                   for="last_name">Last name</label>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="email"
                                   id="email"
                                   class="form-control"
                                   value="<?php echo $user->email?>"
                                   name="email"/>
                            <label class="form-label"
                                   for="email">Email</label>
                        </div>

                        <div class="form-outline form-white form-floating mb-4">
                            <input type="password"
                                   id="pass"
                                   class="form-control"
                                   name="pass"/>
                            <label class="form-label"
                                   for="pass">Password</label>
                        </div>

                        <button class="submit btn text-light btn-lg px-5 btn rounded-3 submit"
                                type="submit">Save Changes
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php else: ?>
    <div class="h-100 w-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-center">No user found...</h1>
		<?php redirect("admin/users"); ?>
    </div>
    <?php endif; ?>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>
