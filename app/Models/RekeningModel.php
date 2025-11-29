<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table            = 'rb_rekening'; // Nama tabel di database
    protected $primaryKey       = 'id_rekening'; // Primary key
    protected $useAutoIncrement = true;          // Auto increment
    protected $returnType       = 'array';       // Return array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Field yang boleh diisi (sesuai tabel ecommerce.sql)
    protected $allowedFields    = [
        'nama_bank',
        'no_rekening',
        'pemilik_rekening'
    ];

    // --- Konfigurasi Timestamp ---
    // Tabel rb_rekening tidak memiliki kolom created_at/updated_at
    protected $useTimestamps = false;

    // --- Method Custom ---

    /**
     * Ambil semua rekening atau satu rekening spesifik
     * @param int|false $id
     * @return array|null
     */
    public function getRekening($id = false)
    {
        if ($id === false) {
            // Ambil semua data rekening
            return $this->findAll();
        }

        // Ambil satu data berdasarkan ID
        return $this->find($id);
    }
}