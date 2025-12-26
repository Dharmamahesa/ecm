<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\KonsumenModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek Login Admin
        if (!session()->get('is_admin_logged_in')) {
            return redirect()->to('/');
        }

        $produkModel    = new ProdukModel();
        $transaksiModel = new TransaksiModel();
        $konsumenModel  = new KonsumenModel();

        // Hitung Data untuk Statistik
        $data = [
            'title'       => 'Dashboard Admin',
            'total_produk'=> $produkModel->countAll(),
            // Hitung transaksi yang status prosesnya '0' (Pending)
            'order_baru'  => $transaksiModel->where('proses', '0')->countAllResults(), 
            'total_member'=> $konsumenModel->countAll(),
            // Ambil 5 transaksi terbaru
            'transaksi_terbaru' => $transaksiModel->getAllTransaksi(null) // Limitasi nanti di view saja atau modifikasi model
        ];

        return view('admin/dashboard', $data);
    }
}