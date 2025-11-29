<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="<?= base_url('/') ?>">ECOMMERCE</a>
            <div class="ms-auto">
                <a href="<?= base_url('produk') ?>" class="btn btn-outline-dark btn-sm">Lihat Semua Produk</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="row g-0">
                <div class="col-md-5 bg-white d-flex align-items-center justify-content-center p-4">
                    <img src="<?= base_url('asset/foto_produk/' . $p['gambar']); ?>" class="img-fluid" style="max-height: 400px;" alt="<?= $p['nama_produk']; ?>" onerror="this.src='https://via.placeholder.com/500'">
                </div>
                
                <div class="col-md-7">
                    <div class="card-body p-4 p-md-5">
                        <span class="badge bg-secondary mb-2"><?= $p['nama_kategori'] ?? 'Umum' ?></span>
                        <h1 class="fw-bold"><?= $p['nama_produk']; ?></h1>
                        <h2 class="text-success fw-bold my-3">Rp <?= number_format($p['harga_konsumen'], 0, ',', '.'); ?></h2>
                        
                        <div class="mb-4">
                            <strong>Berat:</strong> <?= $p['berat']; ?> <br>
                            <strong>Stok:</strong> Tersedia
                        </div>

                        <form action="<?= base_url('keranjang/add') ?>" method="post" class="mb-4">
                            <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <label class="col-form-label fw-bold">Jumlah:</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" name="qty" class="form-control" value="1" min="1" style="width: 80px;">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                                        <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        
                        <h5 class="fw-bold mt-4">Deskripsi Produk</h5>
                        <div class="text-muted">
                            <?= nl2br($p['keterangan']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($terkait)): ?>
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Produk Terkait</h4>
            <div class="row">
                <?php foreach($terkait as $t): ?>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="<?= base_url('asset/foto_produk/' . $t['gambar']); ?>" class="card-img-top p-3" style="height: 150px; object-fit: contain;" alt="<?= $t['nama_produk'] ?>">
                        <div class="card-body">
                            <h6 class="card-title text-truncate"><?= $t['nama_produk'] ?></h6>
                            <p class="text-success fw-bold small">Rp <?= number_format($t['harga_konsumen'], 0, ',', '.') ?></p>
                            <a href="<?= base_url('produk/detail/' . $t['produk_seo']) ?>" class="btn btn-outline-primary btn-sm w-100 stretched-link">Lihat</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>