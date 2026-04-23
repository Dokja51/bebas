<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard_admin', 'Dashboard::admin');

$routes->group('', ['filter' => 'admin'], function($routes) {
// perbukuan
$routes->get('/kelola_buku', 'Buku::index');
$routes->get('/create_buku', 'Buku::create');
$routes->post('/store_buku', 'Buku::store');
$routes->get('edit_buku/(:num)', 'Buku::edit/$1');
$routes->post('update_buku/(:num)', 'Buku::update/$1');

$routes->post('buku/delete/(:num)', 'Buku::delete/$1');
// kategori
$routes->get('/kelola_kategori', 'Buku::kategori');
$routes->get('/create_kategori', 'Buku::createKategori');
$routes->post('/store_kategori', 'Buku::storeKategori');
$routes->get('/kelola_user', 'User::index');
$routes->get('/kelola_trans', 'Transaksi::index');
$routes->get('/edit_kategori/(:num)', 'Buku::editKategori/$1');
$routes->post('/kategori/update/(:num)', 'Buku::updateKategori/$1');
$routes->post('/kategori/delete/(:num)', 'Buku::deleteKategori/$1');

$routes->get('kelola_penerbit', 'Penerbit::index');
$routes->get('create_penerbit', 'Penerbit::create');
$routes->post('store_penerbit', 'Penerbit::store');
$routes->get('edit_penerbit/(:num)', 'Penerbit::edit/$1');
$routes->post('update_penerbit/(:num)', 'Penerbit::update/$1');
$routes->post('kelola_penerbit/delete/(:num)', 'Penerbit::delete/$1');

// CRUD user
$routes->get('/user', 'User::index');

$routes->post('kelola_user/delete/(:num)', 'User::delete/$1');

$routes->get('/edit_user/(:num)', 'User::edit/$1');
$routes->post('/update_user/(:num)', 'User::update/$1');
$routes->get('/create_user', 'User::create');
$routes->post('/store_user', 'User::store');

});
// USER
$routes->get('/daftar_buku', 'Buku::daftarBuku');
$routes->get('/daftar_peminjaman', 'Peminjaman::index');
$routes->post('/store_peminjaman', 'Peminjaman::store');
$routes->post('/kembalikan_buku', 'Peminjaman::kembalikan');


$routes->get('/search', 'Buku::search');


service('auth')->routes($routes);
