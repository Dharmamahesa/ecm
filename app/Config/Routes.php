<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Tambahkan di bagian Route Definitions
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/detail/(:segment)', 'Produk::detail/$1');
// --- ROUTE MEMBER (AUTH) ---
$routes->get('auth/register', 'Auth::register');       // Halaman Daftar
$routes->post('auth/register/process', 'Auth::registerProcess'); // Proses Daftar
$routes->post('auth/login/process', 'Auth::loginProcess');       // Proses Login dari Modal
$routes->get('auth/logout', 'Auth::logout');           // Logout

// --- ROUTE ADMIN (BACKEND) ---
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('login', 'Auth::index');              // Halaman Login Admin
    $routes->post('login/process', 'Auth::process');   // Proses Login Admin
    $routes->get('logout', 'Auth::logout');            // Logout Admin
    $routes->get('dashboard', 'Dashboard::index');     // Dashboard Admin
    // --- ROUTE CHECKOUT ---
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout/process', 'Checkout::process');
$routes->get('checkout/sukses/(:segment)', 'Checkout::sukses/$1');
});