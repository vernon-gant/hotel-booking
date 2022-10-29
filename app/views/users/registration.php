<?php
require_once APPROOT . '/views/includes/header.php'
?>
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-10 col-md-8 col-lg-6 h-100">
                <div class="card shadow-lg p-4 p-md-5">
                    <h3 class="fw-bold card-title text-center mb-4">Registration Form</h3>
                    <div class="card-body container">
                        <!--						TODO: continue designing registration form-->
                        <form action="#">
                            <div>
                                <div>
                                    <label for="Email">E-Mail</label>
                                    <input type="email"
                                           id="Email"
                                           required>
                                </div>
                                <div>
                                    <label for="password">Password</label>
                                    <input type="password"
                                           id="password"
                                           required>
                                    <label for="password_repeat">Repeat password</label>
                                    <input type="password"
                                           id="password_repeat"
                                           required>
                                </div>
                                <div>
                                    <label for="first_name">First Name</label>
                                    <input type="text"
                                           id="first_name"
                                           required>
                                    <label for="last_name">Last Name</label>
                                    <input type="text"
                                           id="last_name"
                                           required>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>