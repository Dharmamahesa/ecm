<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); transition: 0.3s; }
        .product-img { height: 200px; object-fit: contain; background: #f8f9fa; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="<?= base_url('/') ?>">ECOMMERCE</a>
            <div class="ms-auto">
                <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary btn-sm">Kembali ke Home</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">Kategori</div>
                    <ul class="list-group list-group-flush">
                        <?php foreach($kategori as $k): ?>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none text-dark"><?= $k['nama_kategori'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <h3 class="fw-bold mb-4">Semua Produk</h3>
                <div class="row">
                    <?php if(empty($produk)): ?>
                        <div class="col-12 text-center py-5">Belum ada produk tersedia.</div>
                    <?php else: ?>
                        <?php foreach ($produk as $p) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <img src="<?= base_url('asset/foto_produk/' . $p['gambar']); ?>" class="card-img-top product-img p-3" alt="<?= $p['nama_produk']; ?>" onerror="this.src='https://via.placeholder.com/300'">
                                <div class="card-body">
                                    <small class="text-muted"><?= $p['nama_kategori'] ?? 'Umum' ?></small>
                                    <h5 class="card-title text-truncate"><?= $p['nama_produk']; ?></h5>
                                    <p class="text-success fw-bold fs-5">Rp <?= number_format($p['harga_konsumen'], 0, ',', '.'); ?></p>
                                    <div class="d-grid">
                                        <a href="<?= base_url('produk/detail/' . $p['produk_seo']); ?>" class="btn btn-primary rounded-pill">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>