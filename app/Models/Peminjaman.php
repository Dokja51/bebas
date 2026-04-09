<?php

namespace App\Models;

use CodeIgniter\Model;

class Peminjaman extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'status'
    ];

    public function getPeminjamanWithBuku()
    {
        return $this->select('transaksi.*, buku.judul')
                    ->join('buku', 'buku.id = transaksi.buku_id')
                    ->orderBy('transaksi.id', 'DESC')
                    ->findAll();
    }
}