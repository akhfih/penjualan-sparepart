<?php

require_once __DIR__ . "/../vendor/autoload.php";

session_start();

use Akhfih\Sparepart\App\Router;
use Akhfih\Sparepart\Controller\BarangController;

Router::add("GET", "/barang", BarangController::class, "index");
Router::add("POST", "/barang", BarangController::class, "store");
Router::add("POST", "/barang/delete/([0-9a-zA-Z]*)", BarangController::class, "delete");
Router::add("GET", "/barang/([0-9a-zA-Z]*)", BarangController::class, "barang");
Router::add("POST", "/barang/([0-9a-zA-Z]*)", BarangController::class, "edit");


Router::run();