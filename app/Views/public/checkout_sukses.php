<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                
                <div class="card border-0 shadow-lg p-4">
                    <div class="text-center text-success mb-3">
                        <i class="fas fa-check-circle fa-5x"></i>
                    </div>
                    <h2 class="fw-bold mb-3">Pesanan Berhasil!</h2>
                    <p class="text-muted">Terima kasih telah berbelanja. Pesanan Anda telah kami terima dan sedang menunggu pembayaran.</p>
                    
                    <div class="bg-light p-3 rounded mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span>No. Invoice:</span>
                            <span class="fw-bold text-primary"><?= $transaksi['kode_transaksi'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Tagihan:</span>
                            <span class="fw-bold text-danger">Rp <?= number_format($total, 0, ',', '.') ?> + Ongkir</span>
                        </div>
                        <small class="text-danger fst-italic">*Total belum termasuk ongkos kirim. Admin akan menghubungi Anda.</small>
                    </div>

                    <h5 class="fw-bold mb-3">Silakan Transfer ke:</h5>
                    <div class="row g-2 mb-4">
                        <?php foreach($rekening as $rek): ?>
                        <div class="col-12">
                            <div class="border rounded p-3 d-flex align-items-center">
                                <i class="fas fa-university fa-2x text-secondary me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold"><?= $rek['nama_bank'] ?></div>
                                    <div class="fs-5"><?= $rek['no_rekening'] ?></div>
                                    <div class="small text-muted">A/N <?= $rek['pemilik_rekening'] ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('member/riwayat') ?>" class="btn btn-outline-primary">Lihat Riwayat Pesanan</a>
                        <a href="<?= base_url('/') ?>" class="btn btn-primary">Belanja Lagi</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>