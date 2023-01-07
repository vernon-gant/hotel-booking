<body>
<div class="grid-container">
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-collapse collapse flex-grow-0" id="navbar">
                    <ul class="navbar-nav me-auto align-items-center justify-content-center">
                        <li class="nav-item me-5 pe-2 me-md-0 my-1 my-md-0">
                            <a class="nav-link mx-2" href="<?php
							echo URL_ROOT . '/pages/blog' ?>">
                                <i class="fa-solid fa-blog pe-2"></i>Blog</a>
                        </li>
                        <li class="nav-item me-5 pe-2 me-md-0 my-1 my-md-0">
                            <a class="nav-link mx-2" href="<?php
							echo URL_ROOT . '/pages/gallery' ?>">
                                <i class="fa-regular fa-images pe-2"></i>Gallery</a>
                        </li>
                        <li class="nav-item me-5 pe-2 me-md-0 my-1 my-md-0">
                            <a class="nav-link mx-2" href="<?php
							echo URL_ROOT . '/pages/help' ?>">
                                <i class="fa-solid fa-circle-info pe-2"></i>Help
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler pull-left ms-lg-3"
                        data-bs-target="#navbar"
                        data-bs-toggle="collapse"
                        type="button">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <a class="navbar-brand border-0 mx-auto ps-md-5 pe-lg-5" href="<?php
				echo
				URL_ROOT
				?>">
                    <img alt="Motel X Logo" draggable="false" height="70" id="Mote-X-logo"
                         class="ps-sm-5 pe-lg-5 me-lg-5"
                         src="<?php
						 echo URL_ROOT; ?>/img/gallery/hotel_logo.png"/>
                </a>
				<?php
				if (isset($_SESSION['user_email'])) : ?>
                    <div class="d-flex justify-content-center align-items-center flex-lg-row flex-column
                    me-2">
                        <button class="btn btn-primary rounded-pill btn-success me-3 my-sm-3 my-lg-0
                        mx-auto">
                            <a class="mx-2 text-decoration-none text-white"
                               href="<?php echo URL_ROOT . '/bookings' ?>">
                                <i class=" fa-solid fa-right-to-bracket pe-2"></i>Book Now!
                            </a>
                        </button>
                        <div class="dropdown mb-sm-3 mb-lg-0">
                            <div data-bs-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false"
                                 class="align-items-center justify-content-center d-lg-block">
                                <i class="fa-regular fa-user me-1 text-white"></i>
                                <span class="mb-0 text-sm font-weight-bold footer-link
                                text-center align-self-center nav-link-color">
                                    Hi <span class="fw-bold"><?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name'] ?></span>!
                                </span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <a href="<?php echo URL_ROOT . '/users/account/profile'?>" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <a href="<?php echo URL_ROOT . '/users/account/bookings'?>" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Bookings</span>
                                </a>
                                <a href="<?php echo URL_ROOT . '/pages/contact'?>" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span>Support</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo URL_ROOT . '/users/logout' ?>"
                                   class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
				<?php
                else : ?>
                    <div class="d-inline-flex me-3">
                        <button class="btn rounded-pill btn-success me-lg-4">
                            <a class="mx-2 text-decoration-none text-white"
                               href="<?php echo URL_ROOT . '/users/login' ?>">
                                <i class=" fa-solid fa-right-to-bracket pe-2"></i>Sign In
                            </a>
                        </button>
                    </div>
				<?php
				endif; ?>
            </div>
        </nav>
    </header>
    <main>
