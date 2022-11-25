<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="container h-100 py-5">
    <div class="table-responsive">
        <div class="table-wrapper">
            <?php flash("user_change_success")?>
            <div class="table-title mb-5">
                <h2 class="fw-bold text-center">User Management</h2>
            </div>
            <table class="table table-striped table-hover align-items-center">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php if(isset($data['users'])) : ?>
	                <?php foreach ($data['users'] as $index => $user) : ?>
                        <?php if ($index == 0) echo "<tbody>"?>
                            <tr>
                                <td><?php echo $user['email']?></td>
                                <td><?php echo $user['first_name'] . " " . $user['last_name']?></td>
                                <td><?php echo date_format(date_create($user['created_at']),"d/m/Y")?></td>
                                <td><?php echo $user['role']?></td>
                                <td>
                                    <form action="<?php echo URL_ROOT . '/admin/users'?>" method="post">
                                        <input class="d-none" name="user_email" value="<?php echo $user['email']?>">
                                        <select onchange="this.form.submit()">
                                            <option <?php if ($user['status'] == 'active') echo "readonly disabled selected"?> value="active">Active</option>
                                            <option <?php if ($user['status'] == 'inactive') echo "readonly disabled selected"?> value="inactive">Inactive</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="ps-0">
                                    <div class="d-flex flex-row justify-content-start">
                                        <a href="<?php echo URL_ROOT . '/admin/users/delete/' . $user['email']?>"><i class="fa-solid fa-trash ms-3"></i></a>
                                        <a href="<?php echo URL_ROOT . '/admin/users/edit/' . $user['email']?>"><i class="fa-solid fa-pen ms-3"></i></a>
                                    </div>
                                </td>
                            </tr>
						<?php if ($index == count($data['users']) - 1) echo "</tbody>"?>
                    <?php endforeach;?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/admin_footer.php'
?>