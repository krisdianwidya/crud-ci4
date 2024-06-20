<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Edit a Post</h1>

<?php if (isset($validation)) { ?>
    <?php echo $validation->listErrors() ?>
<?php } ?>

<form action="/posts/<?= $post['id'] ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="oldImage" value="<?= $post['image']; ?>">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= $post['title']; ?>" /><br>

    <label for="body">Body</label>
    <textarea name="body" id="body"><?= $post['body']; ?></textarea><br>

    <input type="file" name="image" id="image" onchange="previewImg()">
    <img src="<?= $post['image'] ? '/img/' . $post['image'] : 'https://www.codeigniter.com/assets/icons/ci-logo.png'; ?>" alt="image" class="img-preview">
    <br>

    <button type="submit">Save Post</button>
</form>

<p><a href="/posts">Back to Posts</a></p>
<?= $this->endSection() ?>