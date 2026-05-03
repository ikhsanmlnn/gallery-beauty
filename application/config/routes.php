<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Galeri';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Galeri routes
$route['galeri']            = 'Galeri/index';
$route['galeri/create']     = 'Galeri/create';
$route['galeri/store']      = 'Galeri/store';
$route['galeri/edit/(:num)'] = 'Galeri/edit/$1';
$route['galeri/update/(:num)'] = 'Galeri/update/$1';
$route['galeri/delete/(:num)'] = 'Galeri/delete/$1';
$route['galeri/detail/(:num)'] = 'Galeri/detail/$1';

// Anggota route
$route['anggota'] = 'Anggota/index';
