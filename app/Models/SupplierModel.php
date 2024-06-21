<?php

namespace App\Models;

use CodeIgniter\Model;

class SuplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama_supplier', 'no_telp', 'alamat'];
}
