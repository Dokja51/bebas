<?php

namespace App\Models;

use CodeIgniter\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit'; // ⚠️ sesuaikan dengan nama tabel di DB
    protected $primaryKey = 'id_penerbit';
    protected $allowedFields = ['nama_penerbit'];
}