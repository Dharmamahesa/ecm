<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriProdukModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        // Memuat Model
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriProdukModel();
    }

    // Menampilkan Daftar Semua Produk
    public function index()
    {
        $data = [
            'title'    => 'Katalog Produk Kami',
            // Menggunakan method getProdukLengkap() yang sudah kita buat di Model
            'produk'   => $this->produkModel->getProdukLengkap(),
            // Mengambil kategori untuk filter/sidebar (opsional)
            'kategori' => $this->kategoriModel->findAll() 
        ];

        return view('public/produk_list', $data);
    }

    // Menampilkan Detail Satu Produk
    public function detail($seo)
    {
        // Ambil data produk berdasarkan SEO/Slug
        $produk = $this->produkModel->getDetailBySeo($seo);

        // Jika produk tidak ditemukan (misal url salah ketik)
        if (empty($produk)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Produk tidak ditemukan: ' . $seo);
        }

        // (Opsional) Ambil Produk Terkait (Produk dalam kategori yang sama)
        $terkait = $this->produkModel->where('id_kategori_produk', $produk['id_kategori_produk'])
                                     ->where('id_produk !=', $produk['id_produk']) // Jangan tampilkan produk yang sedang dibuka
                                     ->orderBy('waktu_input', 'DESC')
                                     ->findAll(4);

        $data = [
            'title'   => $produk['nama_produk'],
            'p'       => $produk,
            'terkait' => $terkait
        ];

        return view('public/produk_detail', $data);
    }
}