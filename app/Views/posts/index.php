<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('message')) : ?>
    <?= session()->getFlashdata('message'); ?>
<?php endif ?>
<div>
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Post Listing</h3>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 mb-3">All posts listed here.</p>
        <a class="bg-gray-800 text-sm font-semibold leading-6 text-white p-2" href="/posts/new">Create Post</a>
    </div>
</div>
<div class="mt-6 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
        <?php if ($posts !== []) : ?>
            <?php foreach ($posts as $post) : ?>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                    <a class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" href="/posts/<?= $post['id'] ?>"><?= esc($post['title']) ?></a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>no</p>
        <?php endif ?>

    </dl>
</div>
<?= $this->endSection() ?>