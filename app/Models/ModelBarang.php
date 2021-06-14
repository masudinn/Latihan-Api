<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{

    protected $table = 'tb_product';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['nama_produk', 'deskripsi_produk'];
}
