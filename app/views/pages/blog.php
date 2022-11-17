<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
	<div class="container p-5">
        <?php if (isset($data['posts'])) : ?>

                <?php foreach ($data['posts'] as $index => $post): ?>

                    <?php if ($index % 3 == 0) echo "<div class='row mx-auto mb-5'>"?>

                        <div class="col-12 col-md-4 mx-auto d-flex align-items-stretch">
                            <div class="card">
                                <div class="card-block d-flex flex-column justify-content-between h-100">
					    			<?php if (isset($post['img'])) echo '<img class="card-img-top" alt="post photo" src="' . mapImagePathToPhoto($post["img"]) .'">'?>
                                    <h4 class="card-title text-center my-2 <?php if (!isset($post['img'])) echo "p-4" ?>"><?php echo $post['title']?></h4>
                                    <h6 class="card-subtitle text-muted text-center mt-2">Written by <?php echo $post['first_name'] . " " . $post['last_name']?></h6>
                                    <p class="card-text p-3 my-2 text-center"><?php echo substr($post['body'],0,60) . "..."?></p>
                                    <p class="card-footer mb-0 text-center"><?php echo date_format(date_create($post['created_at']),"l jS \of F Y")?></p>
                                </div>
                            </div>
                        </div>

				    <?php if (($index + 1) % 3 == 0 and $index != 0) echo "</div>"?>

                <?php endforeach?>
        <?php else: ?>
        <div class="d-flex flex-column flex-grow-1 w-100 justify-content-center">
            <h1>No posts yet...</h1>
        </div>
        <?php endif;?>
	</div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>