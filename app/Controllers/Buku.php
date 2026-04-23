<?php

namespace App\Controllers;

class Buku extends BaseController
{
    // ADMIN
    public function index(): string
    {
        $bukuModel = new \App\Models\Buku();
        $data['buku'] = $bukuModel->getBukuLengkap();
        return view('admin/buku/kelola_buku', $data);
    }

    public function create()
    {
        $kategoriModel = new \App\Models\Kategori();
        $penulisModel = new \App\Models\Penulis();
        $penerbitModel = new \App\Models\Penerbit();
        $data = [
        'penulis' => $penulisModel->findAll(),
        'penerbit' => $penerbitModel->findAll(),
        'kategori' => $kategoriModel->findAll(),
    ];
        return view('admin/buku/create_buku', $data);
    }

   public function store()
{
    $bukuModel = new \App\Models\Buku();

    $file = $this->request->getFile('cover');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads', $newName);
        $coverName = $newName;
    } else {
        $coverName = null;
    }

    $bukuModel->save([
    'judul'        => $this->request->getPost('judul'),
    'kategori_id'  => $this->request->getPost('kategori_id'),
    'id_penulis'   => $this->request->getPost('id_penulis'),
    'id_penerbit'  => $this->request->getPost('id_penerbit'),
    'tahun_terbit' => $this->request->getPost('tahun_terbit'),
    'cover'        => $coverName,
]);

    return redirect()->to('kelola_buku');
}
    public function kategori()
    {
        $kategoriModel = new \App\Models\Kategori();
        $kategori = $kategoriModel->findAll();
        return view('admin/buku/kelola_kategori', ['kategori' => $kategori]);
    }

    public function createKategori()
    {
        $kategoriModel = new \App\Models\Kategori();
        $kategori = $kategoriModel->findAll();
        return view('admin/buku/create_kategori');
    }

    public function storeKategori()
{
    $kategoriModel = new \App\Models\Kategori();

    $namaKategori = $this->request->getPost('nama_kategori');

    if(empty($namaKategori)){
        return redirect()->back()->with('error', 'Nama kategori tidak boleh kosong');
    }

    $kategoriModel->save([
        'nama_kategori' => $namaKategori
    ]);

    return redirect()->to('/kelola_kategori')->with('success', 'Kategori berhasil disimpan');
}
// ADMIN END

public function daftarBuku()
    {
        $bukuModel = new \App\Models\Buku();
        $data['buku'] = $bukuModel->getBukuLengkap();
        return view('user/daftar_buku', $data);
    }

    public function edit($id)
{
    $bukuModel = new \App\Models\Buku();
    $kategoriModel = new \App\Models\Kategori();
    $penulisModel = new \App\Models\Penulis();
    $penerbitModel = new \App\Models\Penerbit();

    $data['buku'] = $bukuModel->find($id);
    $data['kategori'] = $kategoriModel->findAll();
    $data['penulis'] = $penulisModel->findAll();
    $data['penerbit'] = $penerbitModel->findAll();

    return view('admin/buku/edit_buku', $data);
}

public function update($id)
{
    $bukuModel = new \App\Models\Buku();

    $buku = $bukuModel->find($id);

    $file = $this->request->getFile('cover');
    $coverName = $buku['cover'];

    $bukuModel->update($id, [
    'judul'        => $this->request->getPost('judul'),
    'kategori_id'  => $this->request->getPost('kategori_id'),
    'id_penulis'   => $this->request->getPost('id_penulis'),
    'id_penerbit'  => $this->request->getPost('id_penerbit'),
    'tahun_terbit' => $this->request->getPost('tahun_terbit'),
    'cover'        => $coverName,
]);

    return redirect()->to('/kelola_buku');
}

public function delete($id)
{
    $bukuModel = new \App\Models\Buku();

    // ambil data dulu (buat hapus cover kalau ada)
    $buku = $bukuModel->find($id);

    if ($buku) {
        // hapus file cover kalau ada
        if ($buku['cover'] && file_exists(FCPATH . 'uploads/' . $buku['cover'])) {
            unlink(FCPATH . 'uploads/' . $buku['cover']);
        }

        // hapus data dari database
        $bukuModel->delete($id);
    }

    return redirect()->to('/kelola_buku')->with('success', 'Buku berhasil dihapus');
}

}
