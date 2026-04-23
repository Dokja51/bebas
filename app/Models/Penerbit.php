<?php

namespace App\Models;

use CodeIgniter\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_penerbit',
        'alamat',
        'telepon'
    ];
}