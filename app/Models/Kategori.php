<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nama_kategori'];
}