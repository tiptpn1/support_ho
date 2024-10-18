<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'user';
$route['home'] = 'user/index';
$route['daftar_antrian'] = 'user/daftar_antrian';
$route['user/get_tiket/(:any)'] = 'user/get_tiket/$1';
$route['panel/cetak_label/(:any)'] = 'panel/cetak_label/$1';

$route['perangkat'] = 'panel/perangkat';
$route['tambah_perangkat'] = 'panel/tambah_perangkat';
$route['ubah_perangkat'] = 'panel/ubah_perangkat';
$route['pengajuan_lelang'] = 'panel/pengajuan_lelang';
$route['tambah_pengajuan'] = 'panel/tambah_pengajuan';
$route['ubah_pengajuan'] = 'panel/ubah_pengajuan';
$route['master_perangkat'] = 'panel/master_perangkat';
$route['tambah_master_perangkat'] = 'panel/tambah_master_perangkat';
$route['ubah_master_perangkat'] = 'panel/ubah_master_perangkat';
$route['master_jenis'] = 'panel/master_jenis';
$route['tambah_master_jenis'] = 'panel/tambah_master_jenis';
$route['ubah_master_jenis'] = 'panel/ubah_master_jenis';
$route['master_layanan'] = 'panel/master_layanan';
$route['tambah_master_layanan'] = 'panel/tambah_master_layanan';
$route['ubah_master_layanan'] = 'panel/ubah_master_layanan';
$route['bar_qr_code'] = 'panel/bar_qr_code';
$route['ubah_tiket'] = 'panel/ubah_tiket';
$route['detail_keluhan'] = 'panel/detail_keluhan';
$route['semua_notif'] = 'panel/semua_notif';
$route['laporan_grafik'] = 'panel/laporan_grafik';
$route['laporan_tabel'] = 'panel/laporan_tabel';
$route['kelola_artikel'] = 'panel/kelola_artikel';
$route['tambah_artikel'] = 'panel/tambah_artikel';
$route['ubah_artikel'] = 'panel/ubah_artikel';
$route['lihat_artikel'] = 'panel/lihat_artikel';
$route['info'] = 'panel/info';
$route['tambah_info'] = 'panel/tambah_info';
$route['ubah_info'] = 'panel/ubah_info';
$route['daftar_pengguna'] = 'panel/daftar_pengguna';
$route['tambah_pengguna'] = 'panel/tambah_pengguna';
$route['ubah_pengguna'] = 'panel/ubah_pengguna';
$route['daftar_bagian'] = 'panel/daftar_bagian';
$route['tambah_bagian'] = 'panel/tambah_bagian';
$route['ubah_bagian'] = 'panel/ubah_bagian';
$route['daftar_kantor'] = 'panel/daftar_kantor';
$route['tambah_kantor'] = 'panel/tambah_kantor';
$route['ubah_kantor'] = 'panel/ubah_kantor';
$route['list_role'] = 'panel/list_role';
$route['profil'] = 'panel/profil';
$route['ubah_sandi'] = 'panel/ubah_sandi';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['get_jam_masuk'] = 'panel/getJamMasuk';
$route['get_jam_selesai'] = 'panel/getJamKeluar';

// kholil
$route['ganti_qr_code'] = 'Panel/gantiQrCode';
$route['panel/get_tiket'] = 'Panel/get_tiket';
// $route['show_qr_code/(:any)'] = 'Panel/show_qr_code/$1';
