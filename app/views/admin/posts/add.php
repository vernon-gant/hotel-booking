<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="d-flex flex-column h-100">
    <div class="py-5 px-2 bg-light rounded-3 d-flex flex-grow-1">
        <a href="<?php echo URL_ROOT; ?>/admin/blog" class="btn btn-light"><i class="fa-solid fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">
            <h2>Add Post</h2>
            <p>Create a post with this form</p>
            <form action="<?php echo URL_ROOT; ?>/posts/add" method="post">
                <div class="form-group">
                    <label class="form-label" for="title">Title: <sup>*</sup></label>
                    <input type="text" id="title" name="title" class="form-control form-control-lg <?php echo (!empty($data['post_title_err'])) ? 'is-invalid' : ''; ?>"
                           value="<?php echo $data['post_title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['post_title_err']; ?></span>
                </div>
                <div class="form-group">
                    <label class="form-label" for="body">Body: <sup>*</sup></label>
                    <textarea name="body" id="body"
                              class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                </div>
                <input type="submit" class="btn btn-success" value="Submit">
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/admin_footer.php' ?>
