<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Create a New Post</h1>

<?php if (isset($validation)) { ?>
    <?php echo $validation->listErrors() ?>
<?php } ?>

<form action="/posts" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" /><br>

    <label for="body">Body</label>
    <textarea name="body" id="body"></textarea><br>

    <input type="file" name="image" id="image" onchange="previewImg()">
    <img src="https://www.codeigniter.com/assets/icons/ci-logo.png" alt="image" class="img-preview">
    <br>

    <button type="submit">Create Post</button>
</form>

<p><a href="/posts">Back to Posts</a></p>
<?= $this->endSection() ?>