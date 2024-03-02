<?php

namespace Akhfih\Sparepart\Model;

use Exception;
use Akhfih\Sparepart\App\Database;

class BarangModel {
    private $table = "m_barang";
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getAllBarang() {
        $this->database->query("SELECT * FROM {$this->table}");
        return $this->database->resultSet();
    }

    public function getBarangById($id) {
        $this->database->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->database->bind("id", $id);
        return $this->database->single();
    }

    public function createBarang($data) {
        $result = $this->getBarangByKode($data["kode_barang"]);
        if(!empty($result)) {
            throw new Exception("Kode Barang sudah ada");
        }
        

        $query = "INSERT INTO {$this->table} (kode_barang, nama_barang, harga_jual, harga_beli, satuan, kategori) VALUES(:kode_barang, :nama_barang, :harga_jual, :harga_beli, :satuan, :kategori)";
        $this->database->query($query);

        $this->database->bind("kode_barang", $data["kode_barang"]);
        $this->database->bind("nama_barang", $data["nama_barang"]);
        $this->database->bind("harga_jual", $data["harga_jual"]);
        $this->database->bind("harga_beli", $data["harga_beli"]);
        $this->database->bind("satuan", $data["satuan"]);
        $this->database->bind("kategori", $data["kategori"]);

        $this->database->execute();
    }
    public function deleteBarang($id) {
        if(empty($this->getBarangById($id))) {
            throw new Exception("Barang tidak ditemukan");
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

    public function updateBarang($data) {

        if(empty($this->getBarangById($data["id"]))) {
            throw new Exception("Barang tidak ditemukan");
        }

        $result = $this->getBarangByKode($data["kode_barang"]);
        if(!empty($result)) {
            if($result[0]["id"] != $data["id"]) {
                throw new Exception("Kode Barang sudah ada");
            }
        }
        
        $query = "UPDATE {$this->table} SET kode_barang = :kode_barang, nama_barang = :nama_barang, harga_jual = :harga_jual, harga_beli = :harga_beli , satuan = :satuan, kategori = :kategori WHERE id = :id";
        $this->database->query($query);

        $this->database->bind("kode_barang", $data["kode_barang"]);
        $this->database->bind("nama_barang", $data["nama_barang"]);
        $this->database->bind("harga_jual", $data["harga_jual"]);
        $this->database->bind("harga_beli", $data["harga_beli"]);
        $this->database->bind("satuan", $data["satuan"]);
        $this->database->bind("kategori", $data["kategori"]);
        $this->database->bind("id", $data["id"]);

        $this->database->execute();
    }

    public function getBarangByKode($kode_barang) {
        $query = "SELECT * FROM {$this->table} WHERE kode_barang = :kode_barang";
        $this->database->query($query);

        $this->database->bind("kode_barang", "$kode_barang");

        return $this->database->resultSet();
    }

}