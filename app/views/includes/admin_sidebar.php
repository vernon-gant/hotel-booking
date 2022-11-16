<body class="d-flex flex-column vh-100 overflow-hidden">
<div class="container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto">
    <div class="row flex-grow-sm-1 flex-grow-0 p-3">
        <aside class="col-sm-4 col-md-3 col-lg-2 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3">
            <div class="bg-light border rounded-3 p-1 h-100 sticky-top">
                <ul class="mt-3 nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate align-items-center">
                    <li class="nav-item my-3">
                        <a href="<?php echo URL_ROOT . '/admin/index'?>" class="nav-link px-2 text-truncate">
                            <i class="fa-solid fa-house fs-5"></i>
                            <span class="d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="<?php echo URL_ROOT . '/admin/users'?>" class="nav-link px-2 text-truncate">
                            <i class="fa-solid fa-user fs-5"></i>
                            <span class="d-none d-sm-inline">Users</span>
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="<?php echo URL_ROOT . '/admin/bookings'?>" class="nav-link px-2 text-truncate">
                            <i class="fa-solid fa-clock fs-5"></i>
                            <span class="d-none d-sm-inline">Bookings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo URL_ROOT . '/admin/blog'?>" class="nav-link px-2 text-truncate">
                            <i class="fa-solid fa-blog fs-5"></i>
                            <span class="d-none d-sm-inline">Blog</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="col overflow-auto h-100">


