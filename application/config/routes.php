<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Wali_murid';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// hero page
$route['validasi'] = 'Wali_murid/validasi';
$route['validasi-siswa'] = 'Wali_murid/validasi_siswa';

// login
$route['login'] = 'Login';
// $route['registration'] = 'Login/registration';
$route['logout'] = 'Login/logout';

// API
$route['api-cek-username'] = 'Api/cekusername';

// cms admin view
$route['admin/dashboard'] = 'Cms_view/dashboard';
$route['admin/guru'] = 'Cms_view/guru';
$route['admin/siswa'] = 'Cms_view/siswa';
$route['admin/wali'] = 'Cms_view/wali';
$route['admin/kelas'] = 'Cms_view/kelas';
$route['admin/kelas/(:num)'] = 'Cms_view/anggota_kelas/$1';
$route['admin/pelajaran'] = 'Cms_view/pelajaran';
$route['admin/pelajaran/(:num)'] = 'Cms_view/detail_pelajaran/$1';
$route['admin/notif'] = 'Cms_view/notif';
$route['admin/topik'] = 'Cms_view/topik';

// CMS Guru View
$route['guru/dashboard'] = 'Guru_view/dashboard';
$route['guru/kelas'] = 'Guru_view/kelas';
$route['guru/kelas/(:num)'] = 'Guru_view/siswakelas/$1';
$route['guru/siswa'] = 'Guru_view/siswa';
$route['guru/materi'] = 'Guru_view/materi';
$route['guru/tugas'] = 'Guru_view/tugas';
$route['guru/tugas/(:num)/(:num)'] = 'Guru_view/tugas_progress/$1/$2';
$route['guru/nilai'] = 'Guru_view/datanilai';
$route['guru/nilai/(:num)/(:num)'] = 'Guru_view/detail_datanilai/$1/$2';
$route['guru/rekap/(:num).(:num)'] = 'Guru_view/rekap_nilai/$1/$2';
$route['guru/rekap_tugas/(:num).(:num)'] = 'Guru_view/rekap_tugas/$1/$2';
$route['guru/rekap_nilai_kelas/(:num).(:num)'] = 'Guru_view/rekap_nilai_kelas/$1/$2';


// Guru Save
$route['guru-add-tugas'] = 'Guru_save/sendtugas';
$route['guru-add-materi'] = 'Guru_save/sendmateri';
$route['guru-nilai-tugas'] = 'Guru_save/nilaitugas';
$route['guru-update-password-guru'] = 'Guru_save/password_guru';

// cms admin save
$route['admin-add-guru'] = 'Cms_save/addguru';
$route['admin-add-siswa'] = 'Cms_save/addsiswa';
$route['admin-add-mapel'] = 'Cms_save/addmapel';
$route['admin-add-kelas'] = 'Cms_save/addkelas';
$route['admin-add-topik-pelajaran'] = 'Cms_save/topik_pelajaran';

// cms update
$route['admin-update-guru'] = 'Cms_update/data_guru';
$route['admin-update-siswa'] = 'Cms_update/data_siswa';
$route['admin-update-pelajaran'] = 'Cms_update/data_pelajaran';
$route['admin-update-password-guru'] = 'Cms_update/password_guru';
$route['admin-update-password-siswa'] = 'Cms_update/password_siswa';
$route['admin-update-topik-pelajaran'] = 'Cms_update/topik_pelajaran';

// delete
$route['admin-delete-guru/(:num)'] = 'Cms_delete/delete_guru/$1';
$route['admin-delete-siswa/(:num)'] = 'Cms_delete/delete_siswa/$1';
$route['admin-delete-pelajaran/(:num)'] = 'Cms_delete/delete_pelajaran/$1';
$route['admin-delete-kelas/(:num)'] = 'Cms_delete/delete_kelas/$1';
$route['admin-delete-topik/(:num)'] = 'Cms_delete/delete_topik/$1';

$route['guru-delete-materi/(:num)'] = 'Cms_delete/delete_materi/$1';

// restfull api
// POST
$route['api/login'] = 'Restfull_api/login';
$route['api/upload-jawaban'] = 'Restfull_api/upload_jawaban';

$route['api/reset_pw'] = 'Restfull_api/reset_pw';

// GET
$route['api/cek-tugas/(:num)'] = 'Restfull_api/cek_tugas/$1';
$route['api/cek-tugas/(:num)/(:num)'] = 'Restfull_api/cek_detail_tugas/$1/$2';

// Cron Jobs
$route['cron-notification-unsubmit'] = 'Restfull_api/blastdaily';