<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('message')) : ?>
    <?= session()->getFlashdata('message'); ?>
<?php endif ?>
<div>
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Transaksi Listing</h3>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 mb-3">All transactions listed here.</p>
        <a class="bg-gray-800 text-sm font-semibold leading-6 text-white p-2" href="/transaksi/new">Create Transaction</a>
    </div>
</div>
<div class="mt-6 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
        <?php if ($transactions !== []) : ?>
            <?php foreach ($transactions as $transaksi) : ?>
                <div class="px-4 py-6">
                    <span class="text-sm font-medium leading-6 text-gray-900">Transaksi No.</span>
                    <a class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" href="/transaksi/<?= $transaksi['id_transaksi'] ?>/edit"><?= esc($transaksi['id_transaksi']) ?></a>
                    <span class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= esc($transaksi['nama_pembeli']) ?></span>
                    <span class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= esc($transaksi['nama_barang']) ?></span>
                    <form action="/transaksi/<?= $transaksi['id_transaksi'] ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" onclick="return confirm('yakin untuk menghapus')">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>no</p>
        <?php endif ?>

    </dl>
</div>
<?= $this->endSection() ?>