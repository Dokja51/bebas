<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    public function index()
{
    $peminjamanModel = new \App\Models\Peminjaman();
    $user = auth()->user(); // ambil user login

    // Ambil semua peminjaman user, join dengan tabel buku & kategori
    $data['peminjaman'] = $peminjamanModel
    ->select('transaksi.*, buku.judul, penulis.nama_penulis, penerbit.nama_penerbit, buku.tahun_terbit, kategori.nama_kategori')
    ->join('buku', 'buku.id = transaksi.buku_id')
    ->join('penulis', 'penulis.id_penulis = buku.id_penulis')
    ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit')
    ->join('kategori', 'kategori.id = buku.kategori_id')
    ->where('transaksi.user_id', $user->id)
    ->where('transaksi.status', 'dipinjam')
    ->orderBy('transaksi.tanggal_pinjam', 'DESC')
    ->findAll();

    return view('user/daftar_peminjaman', $data);
}

    public function create()
    {
        $bukuModel = new \App\Models\Buku();
        $data['buku'] = $bukuModel->findAll();
        return view('admin/peminjaman/create_peminjaman', $data);
    }

    public function store()
{
    $peminjamanModel = new \App\Models\Peminjaman();
    $bukuModel = new \App\Models\Buku();

    $user = auth()->user();
    $buku_id = $this->request->getPost('buku_id');

    // Ambil data buku
    $buku = $bukuModel->find($buku_id);

    // ❌ Kalau buku tidak ada
    if (!$buku) {
        return redirect()->back()->with('error', 'Buku tidak ditemukan');
    }

    // ❌ Kalau stok habis
    if ($buku['stok'] <= 0) {
        return redirect()->back()->with('error', 'Stok buku habis, tidak bisa dipinjam!');
    }

    // ✅ Simpan transaksi
    $peminjamanModel->save([
        'user_id'        => $user->id,
        'buku_id'        => $buku_id,
        'tanggal_pinjam' => date('Y-m-d'),
        'status'         => 'dipinjam'
    ]);

    // ✅ Kurangi stok
    $bukuModel->update($buku_id, [
        'stok' => $buku['stok'] - 1
    ]);

    return redirect()->to('/daftar_peminjaman')
        ->with('success', 'Buku berhasil dipinjam');
}

    public function kembalikan()
{
    $transaksi_id = $this->request->getPost('transaksi_id');
    $peminjamanModel = new \App\Models\Peminjaman();

    $peminjaman = $peminjamanModel->find($transaksi_id);

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    }

    $peminjamanModel->update($transaksi_id, [
        'tanggal_kembali' => date('Y-m-d'),
        'status' => 'dikembalikan'
    ]);

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
}
}