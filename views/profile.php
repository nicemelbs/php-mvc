<?php
/**
 * @var $user \app\models\User
 */
?>

<h1>Profile Page</h1>
<div class="container">
    <h3><?= $user->getDisplayName() ?></h3>
    <div class="container"><?= $user->email ?></div>

    <?php $post = $user->getPosts()[0]; ?>
    <?php if ($post): ?>
        <h3><?= $post->title ?></h3>
        <div class="container"> <?= $post->body ?></div>

    <?php endif; ?>
</div>
