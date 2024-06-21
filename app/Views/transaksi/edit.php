<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Edit Transaction</h1>

<?php if (isset($validation)) { ?>
    <?php echo $validation->listErrors() ?>
<?php } ?>

<form action="/transaksi/<?= $transaction[0]['id_transaksi'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PATCH">
    <?php if ($products !== []) : ?>
        <label for="barang">Barang yang dibeli:</label>
        <select name="barang" id="barang">
            <option value="">Pilih barang</option>
            <?php foreach ($products as $barang) : ?>
                <option value="<?= esc($barang['id_barang']) ?>" <?= $barang['id_barang'] == $transaction[0]['id_barang'] ? 'selected' : '' ?>><?= esc($barang['nama_barang']) ?></option>
            <?php endforeach; ?>
        </select>
    <?php else : ?>
        <p>no</p>
    <?php endif ?>
    <br>
    <?php if ($customers !== []) : ?>
        <label for="pembeli">Siapa nama pembeli:</label>
        <select name="pembeli" id="pembeli">
            <option value="">Pilih pembeli</option>
            <?php foreach ($customers as $pembeli) : ?>
                <option value="<?= esc($pembeli['id_pembeli']) ?>" <?= $pembeli['id_pembeli'] == $transaction[0]['id_pembeli'] ? 'selected' : '' ?>><?= esc($pembeli['nama_pembeli']) ?></option>
            <?php endforeach; ?>
        </select>
    <?php else : ?>
        <p>no</p>
    <?php endif ?>
    <br>
    <label for="tanggal">Tanggal:</label>
    <input type="date" id="tanggal" name="tanggal">
    <br>
    <label for="keterangan">Keterangan</label>
    <textarea name="keterangan" id="keterangan"></textarea><br>
    <br>

    <button type="submit">Save Transaction</button>
</form>

<p><a href="/transaksi">Back to All Transactions</a></p>
<?= $this->endSection() ?>