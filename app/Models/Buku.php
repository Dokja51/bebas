<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_buku',
        'kategori_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function getBukuWithKategori()
    {
        return $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->get()
            ->getResultArray();
    }

    public function getDetail($id)
    {
        return $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->where('buku.id', $id)
            ->get()
            ->getRowArray();
    }
}