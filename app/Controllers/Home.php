<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\BeritaModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $beritaModel;

    public function __construct()
    {
        // Load Model yang dibutuhkan
        $this->produkModel = new ProdukModel();
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Toko Online Terlengkap',
            // Ambil berita headline untuk Slider (Carousel)
            'slider'    => $this->beritaModel->getHeadline(), 
            // Ambil 6 produk terbaru untuk ditampilkan di depan
            'produk'    => $this->produkModel->getProdukTerbaru(6), 
            // Ambil 3 berita terbaru untuk bagian blog/info
            'berita'    => $this->beritaModel->getBeritaTerbaru(3) 
        ];

        // Tampilkan ke View (kita akan buat view ini di langkah selanjutnya)
        return view('public/home', $data);
    }
}