<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Posts</title>
</head>

<body>
    <?php if (session()->getFlashdata('message')) : ?>
        <?= session()->getFlashdata('message'); ?>
    <?php endif ?>
    <h1>Posts</h1>
    <a href="/posts/new">Create New Post</a>
    <ul>
        <?php if ($posts !== []) : ?>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <a href="/posts/<?= $post['id'] ?>"><?= esc($post['title']) ?></a>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <p>no</p>
        <?php endif ?>
    </ul>
</body>

</html>