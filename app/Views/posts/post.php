<!-- app/Views/posts/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>

<body>
    <h1>Detail</h1>
    <ul>
        <li>Judul: <?= $post['title']; ?></li>
        <li>Detail post: <?= $post['body']; ?></li>
        <li>Tanggal dibuat: <?= $post['created_at']; ?></li>
        <li>Tanggal diupdate: <?= $post['updated_at']; ?></li>
    </ul>
    <a href="/posts/<?= $post['id'] ?>/edit">Edit</a>
    <form action="/posts/<?= $post['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" onclick="return confirm('yakin untuk menghapus')">Delete</button>
    </form>
</body>

</html>