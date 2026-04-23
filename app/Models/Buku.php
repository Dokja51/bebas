<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'ISBN',
        'kategori_id',
        'id_penulis',
        'id_penerbit',
        'judul',
        'tahun_terbit',
        'stok',
        'cover'
    ];


    public function getBukuLengkap($penulis = null, $penerbit = null)
{
    $builder = $this->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
        ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
        ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
        ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left');

    if ($penulis) {
        $builder->where('buku.id_penulis', $penulis);
    }

    if ($penerbit) {
        $builder->where('buku.id_penerbit', $penerbit);
    }

    return $builder->findAll();
}

  
    public function getDetail($id)
    {
        return $this->select('buku.*, 
                              kategori.nama_kategori, 
                              penulis.nama_penulis, 
                              penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->where('buku.id', $id)
            ->first();
    }

    
}