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

        <?php
        $posts = $user->getPosts();

        if (!empty($posts)) {
            echo "<ul>";
            foreach ($posts as $post) {
                echo "<li><a href='/news/" . $post->primaryValue() . "'>" . $post->title . "</a></li>";
            }

            echo "</ul>";
        }
        ?>

    <?php else: ?>
        <div class="alert alert-warning"><h4>User not found.</h4></div>
    <?php endif; ?>

</div>
