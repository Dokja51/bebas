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
        'kode_buku',
        'kategori_id',
        'id_penulis',
        'id_penerbit',
        'judul',
        'tahun_terbit',
        'stok',
        'cover'
    ];


    public function getBukuLengkap()
    {
        return $this->select('buku.*, 
                              kategori.nama_kategori, 
                              penulis.nama_penulis, 
                              penerbit.nama_penerbit')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->findAll();
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