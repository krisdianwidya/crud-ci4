<!-- app/Views/posts/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>

<body>
    <h1>Edit a Post</h1>

    <?php if (isset($validation)) { ?>
        <?php echo $validation->listErrors() ?>
    <?php } ?>

    <form action="/posts/<?= $post['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PATCH">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $post['title']; ?>" /><br>

        <label for="body">Body</label>
        <textarea name="body" id="body"><?= $post['body']; ?></textarea><br>

        <button type="submit">Save Post</button>
    </form>

    <p><a href="/posts">Back to Posts</a></p>
</body>

</html>