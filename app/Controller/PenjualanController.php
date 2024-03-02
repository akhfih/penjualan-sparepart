<?php

namespace Akhfih\Sparepart\Controller;

use Exception;
use Akhfih\Sparepart\App\View;
use Akhfih\Sparepart\App\FlashMessage;
use Akhfih\Sparepart\Model\BarangModel;
use Akhfih\Sparepart\Model\PenjualanModel;

class PenjualanController {
    public function index() {
        $model = [];
        $result = new PenjualanModel();        
        $model += [
            "penjualan" => $result->getAllPenjualan()
        ];
        $result = new BarangModel();
        $model += [
            "barang" => $result->getAllBarang()
        ];
        
        View::render("penjualan/index", $model);
    }

    public function store() {      
        $data = [
            "tanggal_faktur" => $_POST["tanggal_faktur"],
            "no_faktur" => $_POST["no_faktur"],
            "nama_konsumen" => $_POST["nama_konsumen"],
            "kode_barang" => 5,
            "jumlah" => $_POST["jumlah"],
            "harga_satuan" => $_POST["harga_satuan"],
            "harga_total" => $_POST["harga_total"],
        ];

    

        if(empty(trim($data["tanggal_faktur"])) || empty($data["no_faktur"])|| empty($data["nama_konsumen"]) || empty($data["kode_barang"])) {
            FlashMessage::setFlashMessage("error", "Form tidak boleh kosong");
            $this->sendFormInput($data);
            header("Location: /penjualan");
            exit(0);
        }
       
        try {
           
            $model = new PenjualanModel();
            $model->createPenjualan($data);
           
            
            FlashMessage::setFlashMessage("success", "Penjualan berhasil ditambah");
            header("Location: /penjualan");
            exit(0);
        } catch (Exception $exception) {
            FlashMessage::setFlashMessage("error", $exception->getMessage());
            $this->sendFormInput($data);
            header("Location: /penjualan");
            exit(0);
        }
    }

    public function sendFormInput(array $data) : void {
        $_SESSION["form-input"] = [];
        foreach($data as $key => $input) {
            if(gettype($input) == "array") {
                if(!empty($input)) {
                    $_SESSION["form-input"] += [
                        "$key" => $input
                    ];
                }
            } else if(!empty(trim($input))) {
                $_SESSION["form-input"] += [
                    "$key" => trim($input)
                ];
            }
        }
    }
}