<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_barang', 'id_pembeli', 'tanggal', 'keterangan'];
}
