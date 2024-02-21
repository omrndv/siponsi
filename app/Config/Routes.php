<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Siswa::index');
$routes->get('/poin-saya', 'Siswa::poin');
$routes->get('/daftar-bootcamp', 'Siswa::bootcamp');

$routes->post('/up-aduan', 'Siswa::postaduan');

$routes->get('/dashboard', 'Guru::index');
$routes->get('/absensi', 'Guru::absen');
$routes->get('/rekapitulasi', 'Guru::rekap');
$routes->get('/rekapitulasi-piket', 'Guru::piket');
$routes->get('/daftar-absensi', 'Guru::daftarabsen');
$routes->get('/daftar-bootcamp-siswa', 'Guru::bootcamp');

$routes->post('/simpan-presensi', 'Guru::simpanpresensi');
$routes->post('/update-poin', 'Guru::updatepoin');
$routes->post('/updatetugas', 'Guru::sendtugas');

$routes->get('/poin', 'Guru::poin');
$routes->get('/detailsiswa', 'Guru::detailsiswa');
$routes->get('/upload-tugas', 'Guru::tugas');

$routes->get('/login', 'Auth::index');
$routes->get('/login-siswa', 'Auth::siswa');

$routes->post('/login', 'Auth::proseslogin');
$routes->post('/login-siswa', 'Auth::prosesloginsiswa');

$routes->get('logout', 'Auth::logout');
$routes->get('absensi/lihat/(:any)', 'AbsensiController::lihat/$1');
$routes->get('lihat/(:any)', 'AbsensiController::lihat_piket/$1');

$routes->post('absen/getKelasByNama', 'Absen::getKelasByNama');

$routes->get('/kotak-aduan', 'Admin::aduan');
$routes->get('/data-guru-smp', 'Admin::datgursmp');
$routes->get('/siswa-smp', 'Admin::datsis');
$routes->get('/rekap-tugas', 'Guru::rekaptugas');
$routes->get('tugas/detail/(:segment)', 'Guru::detail/$1');

$routes->post('/delete', 'Admin::delete');

$routes->post('filter_data', 'Guru::filterData');





