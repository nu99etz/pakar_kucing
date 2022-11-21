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
$route['default_controller'] = 'DashboardController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['auth'] = 'AuthController/index';
$route['auth/register'] = 'AuthController/register';
$route['auth/doLogin'] = 'AuthController/doLogin';
$route['auth/doRegister'] = 'AuthController/doRegister';
$route['auth/doLogout'] = 'AuthController/doLogout';

// Route Kategori Gejala
$route['kategori_gejala'] = 'KategoriGejalaController/index';
$route['kategori_gejala/ajax'] = 'KategoriGejalaController/ajax';
$route['kategori_gejala/create'] = 'KategoriGejalaController/create';
$route['kategori_gejala/store'] = 'KategoriGejalaController/store';
$route['kategori_gejala/edit/(:any)'] = 'KategoriGejalaController/edit/$1';
$route['kategori_gejala/update/(:any)'] = 'KategoriGejalaController/update/$1';
$route['kategori_gejala/destroy/(:any)'] = 'KategoriGejalaController/destroy/$1';

// Route Gejala
$route['gejala'] = 'GejalaController/index';
$route['gejala/ajax'] = 'GejalaController/ajax';
$route['gejala/create'] = 'GejalaController/create';
$route['gejala/createImport'] = 'GejalaController/createImport';
$route['gejala/store'] = 'GejalaController/store';
$route['gejala/importExcel'] = 'GejalaController/importExcel';
$route['gejala/edit/(:any)'] = 'GejalaController/edit/$1';
$route['gejala/update/(:any)'] = 'GejalaController/update/$1';
$route['gejala/destroy/(:any)'] = 'GejalaController/destroy/$1';
$route['gejala/penjelasan_gejala/(:any)'] = 'GejalaController/penjelasanGejala/$1';

// Route Penyakit
$route['penyakit'] = 'PenyakitController/index';
$route['penyakit/ajax'] = 'PenyakitController/ajax';
$route['penyakit/create'] = 'PenyakitController/create';
$route['penyakit/createImport'] = 'PenyakitController/createImport';
$route['penyakit/store'] = 'PenyakitController/store';
$route['penyakit/importExcel'] = 'PenyakitController/importExcel';
$route['penyakit/edit/(:any)'] = 'PenyakitController/edit/$1';
$route['penyakit/update/(:any)'] = 'PenyakitController/update/$1';
$route['penyakit/destroy/(:any)'] = 'PenyakitController/destroy/$1';

// Route Aturan
$route['aturan'] = 'AturanController/index';
$route['aturan/ajax'] = 'AturanController/ajax';
$route['aturan/create'] = 'AturanController/create';
$route['aturan/store'] = 'AturanController/store';
$route['aturan/edit/(:any)'] = 'AturanController/edit/$1';
$route['aturan/update/(:any)'] = 'AturanController/update/$1';
$route['aturan/destroy/(:any)'] = 'AturanController/destroy/$1';

// Route Konsultasi
$route['konsultasi'] = 'KonsultasiController/index';
$route['konsultasi/penjelasan_gejala/(:any)'] = 'KonsultasiController/penjelasanGejala/$1';
// $route['konsultasi/ajax'] = 'KonsultasiController/ajax';
$route['konsultasi/create'] = 'KonsultasiController/create';
$route['konsultasi/result'] = 'KonsultasiController/result';
$route['konsultasi/nextQuestion'] = 'KonsultasiController/nextQuestion';
$route['konsultasi/store'] = 'KonsultasiController/store';
$route['konsultasi/edit/(:any)'] = 'KonsultasiController/edit/$1';
$route['konsultasi/update/(:any)'] = 'KonsultasiController/update/$1';
$route['konsultasi/destroy/(:any)'] = 'KonsultasiController/destroy/$1';
$route['rep_konsultasi'] = 'KonsultasiController/indexReport';
$route['rep_konsultasi/ajax'] = 'KonsultasiController/ajax';
$route['rep_konsultasi/(:any)'] = 'KonsultasiController/getReport/$1';
