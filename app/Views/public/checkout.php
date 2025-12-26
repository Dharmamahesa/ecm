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
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8">
                <form action="<?= base_url('checkout/process') ?>" method="post">
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold py-3"><i class="fas fa-map-marker-alt me-2 text-danger"></i> Alamat Pengiriman</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-bold">Nama Penerima</label>
                                <input type="text" class="form-control" value="<?= $konsumen['nama_lengkap'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Nomor Telepon</label>
                                <input type="text" class="form-control" value="<?= $konsumen['no_telp'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Alamat Lengkap</label>
                                <textarea class="form-control" rows="3" readonly><?= $konsumen['alamat_lengkap'] ?></textarea>
                                <small class="text-muted d-block mt-2">
                                    *Alamat diambil dari profil Anda. Jika ingin ubah, <a href="<?= base_url('member/profile') ?>">Edit Profil</a>.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold py-3"><i class="fas fa-truck me-2 text-primary"></i> Pengiriman</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Kurir</label>
                                    <select name="kurir" class="form-select" required>
                                        <option value="JNE">JNE</option>
                                        <option value="TIKI">TIKI</option>
                                        <option value="POS">POS Indonesia</option>
                                        <option value="GOJEK">Gojek/Grab (Instant)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Paket Layanan</label>
                                    <select name="service" class="form-select" required>
                                        <option value="REG">Reguler (2-3 Hari)</option>
                                        <option value="YES">Kilat/Express (1 Hari)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-1"></i> Biaya ongkir akan dihitung manual oleh admin dan diinformasikan melalui WhatsApp.
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mb-5">BUAT PESANAN SEKARANG</button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold py-3">Ringkasan Belanja</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            <?php foreach($keranjang as $item): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm px-0">
                                <div>
                                    <h6 class="my-0"><?= $item['nama_produk'] ?></h6>
                                    <small class="text-muted"><?= $item['jumlah'] ?> x Rp <?= number_format($item['harga_jual'],0,',','.') ?></small>
                                </div>
                                <span class="text-muted">Rp <?= number_format($item['harga_jual']*$item['jumlah'],0,',','.') ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span class="text-success">Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                        <small class="text-muted d-block text-end mt-1">(Belum termasuk ongkir)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>