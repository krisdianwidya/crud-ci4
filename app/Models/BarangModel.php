<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $useSoftDeletes = false;
    // protected $allowedFields = ['nama_supplier', 'no_telp', 'alamat'];
}
