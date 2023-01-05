<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="d-flex flex-column justify-content-center h-100">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5 d-flex flex-column align-items-center">
            <?php flash('admin_logout_needed'); ?>
            <h1 class="fw-bold">Admin Page</h1>
            <p class="col-md-8 fs-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Autem cum dolor dolore ea eveniet excepturi expedita, minus modi mollitia nostrum, obcaecati perferendis quis
                recusandae repellendus rerum sit suscipit tempore, vitae?
            </p>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>
