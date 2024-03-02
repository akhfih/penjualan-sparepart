<?php

namespace Akhfih\Sparepart\Model;

use Exception;
use Akhfih\Sparepart\App\Database;

class PenjualanModel {
    private $table = "t_penjualan";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllPenjualan() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getPenjulanById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createPenjualan($data) {
        $result = $this->getPenjualanByNoFaktur($data["no_faktur"]);
        if(!empty($result)) {
            throw new Exception("No faktur sudah ada");
        }
        
        try {
            $this->database->beginTransaction();

            $query = "INSERT INTO {$this->table} (tanggal_faktur, no_faktur, nama_konsumen, kode_barang, jumlah, harga_satuan, harga_total) VALUES(:tanggal_faktur, :no_faktur, :nama_konsumen, :kode_barang, :jumlah, :harga_satuan, :harga_total)";
            $this->database->query($query);
            $this->database->bind("tanggal_faktur", $data["tanggal_faktur"]);
            $this->database->bind("no_faktur", $data["no_faktur"]);
            $this->database->bind("nama_konsumen", $data["nama_konsumen"]);
            $this->database->bind("kode_barang", $data["kode_barang"]);
            $this->database->bind("jumlah", $data["jumlah"]);
            $this->database->bind("harga_satuan", $data["harga_satuan"]);
            $this->database->bind("harga_total", $data["harga_total"]);

            $this->database->execute();

            $this->database->commit();

        } catch (Exception $exception) {
        
            $this->database->rollback();
            throw $exception;
        }
    }

    public function deletePenjualan($id) {
    
        if(empty($this->getPenjualanById($id))) {
            throw new Exception("Penjualan tidak ditemukan");
        }

        try {
            $this->database->beginTransaction();

            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $this->database->query($query);
            $this->database->bind("id", $id);
            $this->database->execute();
            
            $this->database->commit();
        } catch (Exception $exception) {
            $this->database->rollback();
            throw $exception;
        }
    }

    public function updatePenjualan($data) {

        if(empty($this->getPenjualanById($data["id"]))) {
            throw new Exception("Penjualan tidak ditemukan");
        }

        $result = $this->getPenjualanByNoFaktur($data["no_faktur"]);
        if(!empty($result)) {
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("Nomor Faktur sudah tersedia");
            }
        }
        
        try {
            $this->database->beginTransaction();
            
            // Update di jurusans
            $query = "UPDATE {$this->table} SET tanggal_faktur = :tanggal_faktur, no_faktur = :no_faktur, nama_konsumen = :nama_konsumen, kode_barang = :kode_barang, jumlah_satuan = :jumlah_satuan, harga_total = :harga_total WHERE id = :id";
            $this->database->query($query);
            $this->database->bind("tanggal_faktur", $data["tanggal_faktur"]);
            $this->database->bind("no_faktur", $data["no_faktur"]);
            $this->database->bind("nama_konsumen", $data["nama_konsumen"]);
            $this->database->bind("kode_barang", $data["kode_barang"]);
            $this->database->bind("jumlah_satuan", $data["jumlah_satuan"]);
            $this->database->bind("harga_total", $data["harga_total"]);
            $this->database->bind("id", $data["id"]);
            $this->database->execute();

            $this->database->commit();
        } catch (Exception $exception) {
            $this->database->rollback();
            throw $exception;
        }
    }

    public function getPenjualanByNoFaktur($no_faktur) {
        $query = "SELECT * FROM {$this->table} WHERE no_faktur = :no_faktur";
        $this->database->query($query);

        $this->database->bind("no_faktur", "$no_faktur");

        return $this->database->resultSet();
    }

    public function getNoFakturById($id) {
        $query = "SELECT no_faktur FROM {$this->table} WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("id", "$id");

        return $this->database->single();
    }
}