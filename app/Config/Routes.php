<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Tambahkan di bagian Route Definitions
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/detail/(:segment)', 'Produk::detail/$1');
