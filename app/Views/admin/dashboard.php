<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('content'); ?>

<h3 class="mb-4">Dashboard Overview</h3>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 h-100">
            <div class="card-header">Pesanan Baru</div>
            <div class="card-body">
                <h1 class="card-title fw-bold"><?= $order_baru ?></h1>
                <p class="card-text">Pesanan menunggu konfirmasi.</p>
                <a href="<?= base_url('admin/transaksi') ?>" class="text-white text-decoration-none">Lihat Detail &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 h-100">
            <div class="card-header">Total Produk</div>
            <div class="card-body">
                <h1 class="card-title fw-bold"><?= $total_produk ?></h1>
                <p class="card-text">Produk aktif di etalase.</p>
                <a href="<?= base_url('admin/produk') ?>" class="text-white text-decoration-none">Kelola Produk &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 h-100">
            <div class="card-header">Pelanggan</div>
            <div class="card-body">
                <h1 class="card-title fw-bold"><?= $total_member ?></h1>
                <p class="card-text">Total member terdaftar.</p>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-bold">Transaksi Terbaru</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No Invoice</th>
                        <th>Pembeli</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Kita potong array agar cuma tampil 5 terakhir
                    $terbaru = array_slice($transaksi_terbaru, 0, 5); 
                    foreach($terbaru as $trx): 
                    ?>
                    <tr>
                        <td><?= $trx['kode_transaksi'] ?></td>
                        <td><?= $trx['nama_lengkap'] ?></td>
                        <td><?= $trx['waktu_transakksi'] ?></td>
                        <td>
                            <?php 
                                if($trx['proses'] == '0') echo '<span class="badge bg-warning text-dark">Pending</span>';
                                elseif($trx['proses'] == '1') echo '<span class="badge bg-info">Proses</span>';
                                elseif($trx['proses'] == '2') echo '<span class="badge bg-success">Dikirim</span>';
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/transaksi/detail/'.$trx['id_penjualan']) ?>" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>