<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - ECommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: #fff; }
        .content { width: 100%; }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 250px;">
        <a href="<?= base_url('admin/dashboard') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4 fw-bold">Admin Panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/transaksi') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/transaksi') !== false) ? 'active' : '' ?>">
                    <i class="fas fa-shopping-bag me-2"></i> Transaksi
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/produk') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/produk') !== false) ? 'active' : '' ?>">
                    <i class="fas fa-box me-2"></i> Produk
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/kategori') ?>" class="nav-link">
                    <i class="fas fa-tags me-2"></i> Kategori
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/berita') ?>" class="nav-link">
                    <i class="fas fa-newspaper me-2"></i> Berita
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/users') ?>" class="nav-link">
                    <i class="fas fa-users me-2"></i> Pengguna
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/32" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?= session()->get('nama') ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="<?= base_url('admin/logout') ?>">Sign out</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <div class="ms-auto">
                    <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Website <i class="fas fa-external-link-alt ms-1"></i></a>
                </div>
            </div>
        </nav>

        <div class="p-4">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>