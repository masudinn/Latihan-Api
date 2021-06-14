<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{

    protected $table = 'tb_product';
    protected $primarKey = 'id_product';
    protected $allowedFiles = ['nama_produk', 'deskripsi_produk'];
}
