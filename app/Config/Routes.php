<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

$routes->group('', ['filter' => 'admin'], function($routes) {
// perbukuan
$routes->get('/kelola_buku', 'Buku::index');
$routes->get('/create_buku', 'Buku::create');
$routes->post('/store_buku', 'Buku::store');
$routes->get('/edit_buku/(:num)', 'Buku::edit/$1');
$routes->post('buku/delete/(:num)', 'Buku::delete/$1');
// kategori
$routes->get('/kelola_kategori', 'Buku::kategori');
$routes->get('/create_kategori', 'Buku::createKategori');
$routes->post('/store_kategori', 'Buku::storeKategori');
$routes->get('/kelola_user', 'User::index');
$routes->get('/kelola_trans', 'Transaksi::index');

$routes->get('/user', 'User::index');

$routes->post('/hapus_user', 'User::delete');

$routes->get('/edit_user/(:num)', 'User::edit/$1');
$routes->post('/update_user/(:num)', 'User::update/$1');

});
// USER
$routes->get('/daftar_buku', 'Buku::daftarBuku');
$routes->get('/daftar_peminjaman', 'Peminjaman::index');
$routes->post('/store_peminjaman', 'Peminjaman::store');
$routes->post('/kembalikan_buku', 'Peminjaman::kembalikan');



service('auth')->routes($routes);
