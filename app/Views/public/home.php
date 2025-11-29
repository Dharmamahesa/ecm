<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* --- Navbar Styling --- */
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            color: #0d6efd !important;
        }

        /* --- Carousel / Slider --- */
        .carousel-item img {
            height: 450px;
            object-fit: cover;
            filter: brightness(0.6); /* Gelapkan gambar sedikit agar teks terbaca */
        }
        .carousel-caption {
            bottom: 20%;
        }
        .carousel-caption h2 {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }

        /* --- Feature Icons Section --- */
        .feature-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-align: center;
        }
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .feature-icon {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        /* --- Product Card --- */
        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }
        .product-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 220px;
            background: #f1f1f1;
        }
        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Agar gambar tidak terpotong */
            padding: 15px;
            transition: transform 0.5s ease;
        }
        .product-card:hover .product-img-wrapper img {
            transform: scale(1.1);
        }
        .card-body {
            padding: 1.2rem;
        }
        .price-tag {
            color: #198754;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* --- News Section --- */
        .news-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .news-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* --- Login Modal Styling --- */
        .modal-header {
            background: #0d6efd;
            color: white;
        }
        .btn-close {
            filter: invert(1);
        }
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 600;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
        }

        /* --- Footer --- */
        footer {
            background: #212529;
            color: #adb5bd;
            padding-top: 50px;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: 0.3s;
        }
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-shopping-bag me-2"></i>ECOMMERCE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('/') ?>">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('produk') ?>">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('berita') ?>">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('hubungi') ?>">Hubungi Kami</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= base_url('keranjang') ?>" class="position-relative text-dark fs-5">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            0
                        </span>
                    </a>
                    
                    <?php if(session()->get('is_konsumen_logged_in') || session()->get('is_admin_logged_in')): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm rounded-pill px-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> Akun Saya
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <?php if(session()->get('is_admin_logged_in')): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">Dashboard Admin</a></li>
                                    <li><a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>">Logout Admin</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="<?= base_url('member/profile') ?>">Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('member/riwayat') ?>">Riwayat Belanja</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">Keluar</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Masuk / Daftar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if(!empty($slider)): ?>
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach($slider as $key => $slide): ?>
                <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                    <img src="<?= base_url('asset/foto_berita/' . $slide['gambar']) ?>" class="d-block w-100" alt="<?= $slide['judul'] ?>" onerror="this.src='https://via.placeholder.com/1200x450?text=Promo+Spesial'">
                    <div class="carousel-caption d-none d-md-block text-start">
                        <div class="container">
                            <h2 class="display-4"><?= $slide['judul'] ?></h2>
                            <p class="lead"><?= substr(strip_tags($slide['isiberita']), 0, 100) ?>...</p>
                            <a href="#" class="btn btn-warning rounded-pill px-4 fw-bold">Lihat Penawaran</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <?php else: ?>
        <div class="bg-dark text-white text-center py-5">
            <h1>Selamat Datang di E-Commerce</h1>
            <p>Belanja hemat, mudah, dan terpercaya</p>
        </div>
    <?php endif; ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="feature-box h-100">
                    <i class="fas fa-truck feature-icon"></i>
                    <h6 class="fw-bold">Pengiriman Cepat</h6>
                    <small class="text-muted">Ke seluruh Indonesia</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box h-100">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h6 class="fw-bold">Pembayaran Aman</h6>
                    <small class="text-muted">Transaksi Terjamin</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box h-100">
                    <i class="fas fa-tags feature-icon"></i>
                    <h6 class="fw-bold">Promo Menarik</h6>
                    <small class="text-muted">Diskon setiap hari</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-box h-100">
                    <i class="fas fa-headset feature-icon"></i>
                    <h6 class="fw-bold">Layanan 24/7</h6>
                    <small class="text-muted">Siap membantu Anda</small>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Produk Terbaru</h3>
            <a href="<?= base_url('produk') ?>" class="btn btn-outline-dark btn-sm rounded-pill">Lihat Semua</a>
        </div>
        
        <div class="row">
            <?php if(!empty($produk)): ?>
                <?php foreach ($produk as $p) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="product-img-wrapper">
                            <img src="<?= base_url('asset/foto_produk/' . $p['gambar']); ?>" alt="<?= $p['nama_produk']; ?>" onerror="this.src='https://via.placeholder.com/300x300?text=Produk'">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1"><?= $p['nama_kategori'] ?? 'Umum' ?></small>
                            <h6 class="card-title text-truncate fw-bold mb-2"><?= $p['nama_produk']; ?></h6>
                            <div class="mt-auto">
                                <p class="price-tag mb-2">Rp <?= number_format($p['harga_konsumen'], 0, ',', '.'); ?></p>
                                <div class="d-grid">
                                    <a href="<?= base_url('produk/detail/' . $p['produk_seo']); ?>" class="btn btn-primary btn-sm rounded-pill">
                                        <i class="fas fa-shopping-cart me-1"></i> Beli
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted">Belum ada produk yang ditampilkan.</div>
            <?php endif; ?>
        </div>
    </div>

    <section class="bg-light py-5">
        <div class="container">
            <h3 class="fw-bold text-center mb-5">Artikel & Informasi</h3>
            <div class="row">
                <?php if(!empty($berita)): ?>
                    <?php foreach($berita as $b): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm news-card">
                            <img src="<?= base_url('asset/foto_berita/' . $b['gambar']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/400x200'">
                            <div class="card-body">
                                <div class="news-date mb-2"><i class="far fa-calendar-alt me-1"></i> <?= $b['tanggal'] ?></div>
                                <h5 class="card-title fw-bold"><?= $b['judul'] ?></h5>
                                <a href="#" class="text-decoration-none fw-bold text-primary">Baca Selengkapnya <i class="fas fa-arrow-right small"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container pb-4">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold mb-3">TENTANG KAMI</h5>
                    <p class="small">Kami menyediakan berbagai produk berkualitas dengan harga terbaik untuk kebutuhan Anda sehari-hari.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold mb-3">LINK CEPAT</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url('produk') ?>">Katalog Produk</a></li>
                        <li class="mb-2"><a href="<?= base_url('cek-resi') ?>">Cek Resi</a></li>
                        <li class="mb-2"><a href="<?= base_url('konfirmasi') ?>">Konfirmasi Pembayaran</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold mb-3">HUBUNGI KAMI</h5>
                    <p class="small mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Contoh No. 123, Jakarta</p>
                    <p class="small mb-1"><i class="fas fa-phone me-2"></i> +62 812 3456 7890</p>
                    <p class="small"><i class="fas fa-envelope me-2"></i> info@ecommerce.com</p>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center pt-3 small">
                &copy; <?= date('Y') ?> E-Commerce CodeIgniter 4. All Rights Reserved.
            </div>
        </div>
    </footer>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-hidden border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-white"><i class="fas fa-sign-in-alt me-2"></i> Masuk Akun</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <ul class="nav nav-tabs nav-fill" id="loginTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active py-3 rounded-0" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-selected="true">
                                <i class="fas fa-user me-1"></i> Pelanggan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 rounded-0" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-selected="false">
                                <i class="fas fa-user-shield me-1"></i> Admin
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="loginTabContent">
                        
                        <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
                            <p class="text-center text-muted mb-4 small">Silakan masuk untuk mulai berbelanja.</p>
                            <form action="<?= base_url('auth/login/process') ?>" method="post"> 
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email / Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="text" name="email_user" class="form-control border-start-0 ps-0 bg-light" placeholder="Masukkan email anda" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                        <input type="password" name="password" class="form-control border-start-0 ps-0 bg-light" placeholder="******" required>
                                    </div>
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary fw-bold">Masuk Sekarang</button>
                                </div>
                                <div class="text-center small">
                                    Belum punya akun? <a href="<?= base_url('auth/register') ?>" class="text-decoration-none fw-bold">Daftar disini</a>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            <p class="text-center text-muted mb-4 small">Area khusus administrator.</p>
                            <form action="<?= base_url('admin/login/process') ?>" method="post">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Username Admin</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user-shield text-muted"></i></span>
                                        <input type="text" name="username" class="form-control border-start-0 ps-0 bg-light" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                                        <input type="password" name="password" class="form-control border-start-0 ps-0 bg-light" placeholder="******" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark fw-bold">Login Administrator</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>