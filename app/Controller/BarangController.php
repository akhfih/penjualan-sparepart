<?php

namespace Akhfih\Sparepart\Controller;

use Exception;
use Akhfih\Sparepart\App\FlashMessage;
use Akhfih\Sparepart\App\View;
use Akhfih\Sparepart\Model\BarangModel;

class BarangController {
    public function index() {
        $model = new BarangModel();
        View::render("barang/index", $model->getAllBarang());
    }

    public function barang($id) {
        $model = new BarangModel();
        $result = $model->getBarangById($id);
        if(!empty($result)) {
            echo json_encode($result);
            exit(0);
        } else {
            echo json_encode(["error" => "empty"]);
            exit(0);
        }
    }

    public function store() {
        $data = [
            "kode_barang" => $_POST["kode_barang"],
            "nama_barang" => $_POST["nama_barang"],
            "harga_jual" => $_POST["harga_jual"],
            "harga_beli" => $_POST["harga_beli"],
            "satuan" => $_POST["satuan"],
            "kategori" => $_POST["kategori"],
        ];

        if(empty(trim($data["kode_barang"])) || empty(trim($data["nama_barang"])) || empty(trim($data["harga_jual"])) || empty(trim($data["harga_beli"])) || empty(trim($data["satuan"])) || empty(trim($data["kategori"]))) {
            FlashMessage::setFlashMessage("error", "Tidak boleh ada yang kosong");
            $this->sendFormInput($data);
            header("Location: /barang");
            exit(0);
        }

        $model = new BarangModel();
        try {
            $model->createBarang($data);
            FlashMessage::setFlashMessage("success", "Barang berhasil ditambah");
            header("Location: /barang");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /barang");
            exit(0);
        }
    }

    public function edit($id) {
        $data = [
            "id" => $id,
            "kode_barang" => $_POST["kode_barang"],
            "nama_barang" => $_POST["nama_barang"],
            "harga_jual" => $_POST["harga_jual"],
            "harga_beli" => $_POST["harga_beli"],
            "satuan" => $_POST["satuan"],
            "kategori" => $_POST["kategori"],
        ];

        if(empty(trim($data["kode_barang"])) || empty(trim($data["nama_barang"])) || empty(trim($data["harga_jual"])) || empty(trim($data["harga_beli"])) || empty(trim($data["satuan"])) || empty(trim($data["kategori"]))){
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            header("Location: /barang");
            exit(0);
        }

        $model = new BarangModel();
        try {
            $model->updateBarang($data);
            FlashMessage::setFlashMessage("success", "Barang berhasil diedit");
            header("Location: /barang");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            header("Location: /barang");
            exit(0);
        }
    }

    public function delete($id) {
        $model = new BarangModel();
        try {
            $model->deleteBarang($id);
            FlashMessage::setFlashMessage("success", "Mata Kuliah berhasil dihapus");
            header("Location: /barang");
            exit(0);
        } catch (Exception $exception) {
            if(preg_match("/23000/", $exception->getMessage())) {
                $message = "Hapus dibatalkan, data terdaftar sebagai Foreign Key di tabel lain";
            } else {
                $message = $exception->getMessage();
            }
            FlashMessage::setFlashMessage("error", $message);
            header("Location: /barang");
            exit(0);
        }
    }

    public function sendFormInput(array $data) : void {
        $_SESSION["form-input"] = [];
        foreach($data as $key => $input) {
            if(!empty(trim($input))) {
                $_SESSION["form-input"] += [
                    "$key" => trim($input)
                ];
            }
        }
    }
}