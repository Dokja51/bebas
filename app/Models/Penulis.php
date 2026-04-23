<?php

namespace App\Models;

use CodeIgniter\Model;

class Penulis extends Model
{
    protected $table = 'penulis'; // ⚠️ sesuaikan dengan nama tabel di DB
    protected $primaryKey = 'id_penulis';
    protected $allowedFields = ['nama_penulis'];
}