<?php

namespace App\Controllers;

class Buku extends BaseController
{
    // ADMIN
    public function index(): string
{
    $bukuModel = new \App\Models\Buku();

    $penulis  = $this->request->getGet('penulis');
    $penerbit = $this->request->getGet('penerbit');

    $data = [
        'buku'     => $bukuModel->getBukuLengkap($penulis, $penerbit),
        'penulis'  => (new \App\Models\Penulis())->findAll(),
        'penerbit' => (new \App\Models\Penerbit())->findAll(),
    ];

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
    'ISBN'         => $this->request->getPost('ISBN'),
    'judul'        => $this->request->getPost('judul'),
    'kategori_id'  => $this->request->getPost('kategori_id'),
    'id_penulis'   => $this->request->getPost('id_penulis'),
    'id_penerbit'  => $this->request->getPost('id_penerbit'),
    'tahun_terbit' => $this->request->getPost('tahun_terbit'),
    'stok'         => $this->request->getPost('stok'),
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

public function editKategori($id)
{
    $kategoriModel = new \App\Models\Kategori();

    $data['kategori'] = $kategoriModel->find($id);

    return view('admin/buku/edit_kategori', $data);
}

public function updateKategori($id)
{
    $kategoriModel = new \App\Models\Kategori();

    $namaKategori = $this->request->getPost('nama_kategori');

    if (empty($namaKategori)) {
        return redirect()->back()->with('error', 'Nama kategori tidak boleh kosong');
    }

    $kategoriModel->update($id, [
        'nama_kategori' => $namaKategori
    ]);

    return redirect()->to('/kelola_kategori')->with('success', 'Kategori berhasil diupdate');
}

public function deleteKategori($id)
{
    $kategoriModel = new \App\Models\Kategori();

    $kategoriModel->delete($id);

    return redirect()->to('/kelola_kategori')->with('success', 'Kategori berhasil dihapus');
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

    $bukuModel->update($id, [
    'judul'        => $this->request->getPost('judul'),
    'kategori_id'  => $this->request->getPost('kategori_id'),
    'id_penulis'   => $this->request->getPost('id_penulis'),
    'id_penerbit'  => $this->request->getPost('id_penerbit'),
    'tahun_terbit' => $this->request->getPost('tahun_terbit'),
]);

    return redirect()->to('/kelola_buku');
}

public function delete($id)
{
    $bukuModel = new \App\Models\Buku();

  
    $buku = $bukuModel->find($id);

    $bukuModel->delete($id);

    return redirect()->to('/kelola_buku')->with('success', 'Buku berhasil dihapus');
}

public function search()
{
    $keyword = $this->request->getGet('keyword');

    if (!empty($keyword)) {
        return redirect()->to('/kelola_buku?keyword=' . urlencode($keyword));
    }

    return redirect()->to('/kelola_buku');
}

}

