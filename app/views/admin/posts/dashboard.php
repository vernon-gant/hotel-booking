<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="d-flex flex-column h-100">
    <div class="py-5 px-2 bg-light rounded-3 d-flex flex-grow-1">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
			<?php flash("post_added"); ?>
            <h1 class="my-2 fs-1">Posts</h1>
			<?php if (isset($data['posts'])) : ?>
				<?php foreach ($data['posts'] as $post) : ?>
                    <div class="card card-body mb-3 w-50 my-5">
                        <?php if (isset($post['img'])) : ?>
                            <img alt="post photo" class="card-img-top img-fluid mb-2" src="<?php echo bakeBlogImagePath($post['img'])?>">
                        <?php endif;?>
                        <h4 class="card-title mx-auto"><?php echo $post['title']; ?></h4>
                        <div class="bg-light p-2 mb-3 mx-auto">
                            Written by <?php echo $post['first_name'] . " " . $post['last_name']; ?> on <?php echo $post['created_at']; ?>
                        </div>
                        <p class="card-text"><?php
							echo $post['body']; ?></p>
                        <a href="<?php echo URL_ROOT; ?>/posts/show/<?php echo $post['id']; ?>" class="btn btn-dark">More</a>
                    </div>
				<?php endforeach; ?>
			<?php else: ?>
                <h2>No posts yet...</h2>
			<?php endif ?>
            <a href="<?php echo URL_ROOT; ?>/admin/posts/add" class="btn btn-primary mt-5">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/admin_footer.php' ?>
