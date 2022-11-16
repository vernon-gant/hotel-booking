<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/admin_sidebar.php';
?>
<div class="d-flex flex-column h-100">
    <div class="py-5 px-2 bg-light rounded-3 d-flex flex-grow-1">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-between">
            <h1>Posts</h1>
            <div class="row mx-auto">
				<?php if (isset($data['posts'])) : ?>
					<?php foreach ($data['posts'] as $post) : ?>
                        <div class="card card-body mb-3">
                            <h4 class="card-title"><?php
								echo $post->title; ?></h4>
                            <div class="bg-light p-2 mb-3">
                                Written by <?php
								echo $post->name; ?> on <?php
								echo $post->postCreated; ?>
                            </div>
                            <p class="card-text"><?php
								echo $post->body; ?></p>
                            <a href="<?php
							echo URL_ROOT; ?>/posts/show/<?php
							echo $post->postId; ?>" class="btn btn-dark">More</a>
                        </div>
					<?php endforeach; ?>
				<?php else: ?>
                    <h2>No posts yet...</h2>
				<?php endif ?>
            </div>
            <a href="<?php echo URL_ROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/admin_footer.php' ?>
