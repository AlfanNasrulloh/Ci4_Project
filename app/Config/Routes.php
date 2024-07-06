<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->setAutoRoute(true);

//user
$routes->get('/user/admin', 'User::admin', ['filter' => 'role:pimpinan']);
$routes->get('/user/admin/detail/(:num)', 'User::detail/$1', ['filter' => 'role:pimpinan']);
$routes->delete('/user/delete/(:num)', 'User::delete/$1', ['filter' => 'role:pimpinan']);

$routes->get('/pegawai', 'Pegawai::index');

$routes->get('/penggajian', 'Penggajian::index');
$routes->get('/penggajian/create', 'Penggajian::create');
$routes->post('/penggajian/store', 'Penggajian::store');
$routes->get('/penggajian/edit/(:num)', 'Penggajian::edit/$1');
$routes->post('/penggajian/update/(:num)', 'Penggajian::update/$1');
$routes->get('/penggajian/delete/(:num)', 'Penggajian::delete/$1');
