<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="d-flex flex-column h-100">
    <div class="py-5 px-2 bg-light rounded-3 d-flex flex-grow-1 flex-column">
        <a href="<?php echo URL_ROOT; ?>/admin/posts/dashboard" class="btn btn-light"><i class="fa-solid fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">
            <div class="card-header mx-auto d-flex flex-column align-items-center bg-transparent">
                <h2 class="card-title">Add Post</h2>
                <p>Create a post with this form</p>
            </div>
            <div class="card-body">
                <form class="h-100" enctype="multipart/form-data" action="<?php echo URL_ROOT; ?>/admin/posts/add" method="post">
                    <div class="d-flex flex-column flex-grow-1 justify-content-between card-body h-100">
                        <div class="form-floating form-outline">
                            <input required type="text" id="title" name="post_title" class="form-control <?php echo (!empty($data['post_title_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['post_title']; ?>">
                            <label class="form-label" for="title">Title: <sup>*</sup></label>
                            <span class="invalid-feedback"><?php echo $data['post_title_err']; ?></span>
                        </div>
                        <div class="form-floating form-outline">
                            <textarea required name="body" id="body"
                                      class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                            <label class="form-label" for="body">Body: <sup>*</sup></label>
                            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                        </div>
                        <div class="form-floating form-outline">
                            <input name="image" id="image" type="file" accept="image/jpeg"
                                   class="form-control form-control">
                            <label class="form-label" for="image">Image</label>
                        </div>
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/admin_footer.php' ?>
