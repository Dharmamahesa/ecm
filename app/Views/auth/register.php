<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">Daftar Akun Baru</h4>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php if(session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/register/process') ?>" method="post">
                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= old('nama_lengkap') ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>No. Telepon</label>
                                    <input type="number" name="no_telp" class="form-control" value="<?= old('no_telp') ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary fw-bold">Daftar Sekarang</button>
                                <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">Kembali ke Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>