<?php
/**
 * @var $user \app\models\User
 */
?>

<h1>Profile Page</h1>
<div class="container">
    <?php if ($user): ?>
        <h3><?= $user->getDisplayName() ?></h3>
        <div class="container"><?= $user->email ?></div>

        <?php $posts = $user->getPosts(); ?>

        <?php if (!empty($posts)): ?>
            <?php $post = $posts[0]; ?>
            <a href="/news/<?= $post->primaryValue() ?>"><h3><?= $post->title ?></h3></a>
            <div class="container"> <?= $post->body ?></div>
        <?php else: ?>
            <div class="alert alert-warning"><h4>No posts to show</h4></div>
        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-warning"><h4>User not found.</h4></div>
    <?php endif; ?>

</div>
