<!-- app/Views/posts/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>

<body>
    <h1>Create a New Post</h1>

    <?php if (isset($validation)) { ?>
        <?php echo $validation->listErrors() ?>
    <?php } ?>

    <form action="/posts" method="post">
        <?= csrf_field() ?>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" /><br>

        <label for="body">Body</label>
        <textarea name="body" id="body"></textarea><br>

        <button type="submit">Create Post</button>
    </form>

    <p><a href="/posts">Back to Posts</a></p>
</body>

</html>