<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembeli extends Model
{
    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';
    protected $useSoftDeletes = false;
    // protected $allowedFields = ['nama_supplier', 'no_telp', 'alamat'];
}
