<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan</title>
    <?php require __DIR__ . "/../layouts/headlinks.php" ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 2em;
        }
        .select2-container--default .select2-selection--single {
            padding: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-top: 4px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

<?php
    use Akhfih\Sparepart\App\FlashMessage;
    FlashMessage::flashMessage();
?>
    
<div class="wrapper">
    <?php require __DIR__ . "/../layouts/nav-aside.php"; ?>

    <!-- Modal -->
    <div class="modal fade" id="penjualanModal" tabindex="-1" aria-labelledby="penjualanModalLabel" aria-hidden="true">
        <!-- form start -->
        <form action="/penjualan" method="post" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penjualanModalLabel">Tambah Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">

                            <div class="form-group">
                                <label for="tanggal_faktur">Tanggal Faktur</label>
                                <input type="date" name="tanggal_faktur" class="form-control" id="tanggal_faktur" value="<?= $_SESSION["form-input"]["tanggal_faktur"] ?? "" ?>">
                            </div>

                            <div class="form-group">
                                <label for="no_faktur">No Faktur</label>
                                <input type="text" name="no_faktur" class="form-control" id="no_faktur" value="<?= $_SESSION["form-input"]["no_faktur"] ?? "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama_konsumen">Nama Konsumen</label>
                                <input type="text" name="nama_konsumen" class="form-control" id="nama_konsumen" value="<?= $_SESSION["form-input"]["nama_konsumen"] ?? "" ?>">
                            </div>
                                    <div class="form-group">
                                        <label for="kode_barang">Kode barang</label>
                                        <select style="width: 100%;" name="id_barang" class="js-example-basic-single" id="kode_barang">
                                            <option value="<?= null ?>" selected disabled>Pilih Kode Barang</option>
                                            <?php
                                             $data = $model["barang"];
                                                foreach( $data  as $barang) {
                                                    if(isset($_SESSION["form-input"]["kode_barang"])) {
                                                        if($_SESSION["form-input"]["kode_barang"] == $barang["kode_barang"]) {
                                                            echo "<option value=" . $barang["kode_barang"] . " selected>" . $barang["kode_barang"] . "</option>";
                                                        } else {
                                                            echo "<option value=" . $barang["kode_barang"] . ">" . $barang["kode_barang"] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=" . $barang["kode_barang"] . ">" . $barang["kode_barang"] . "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?= $_SESSION["form-input"]["jumlah"] ?? "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="harga_satuan">Harga satuan</label>
                                <input type="number" name="harga_satuan" class="form-control" id="harga_satuan" value="<?= $_SESSION["form-input"]["harga_satuan"] ?? "" ?>">
                            </div>
                            <div class="form-group">
                                <label for="harga_total">Harga total</label>
                                <input type="number" name="harga_total" class="form-control" id="harga_total" value="<?= $_SESSION["form-input"]["harga_total"] ?? "" ?>">
                            </div>
                          
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="create_penjualan" class="btn btn-success button-save">Tambah</button>
                </div>
            </div>
            <?php
                if(isset($_SESSION["form-input"])) {
                    unset($_SESSION["form-input"]);
                }
            ?>          
        </form>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Penjualan</h1>
                    </div>
                   
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
								<h3 class="card-title">Penjualan</h3>
								<a class="btn btn-success ml-auto button-create" data-toggle="modal" data-target="#penjualanModal">Tambah Penjualan</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Faktur</th>
                                    <th>No Faktur</th>
                                    <th>Nama Konsumen</th>
                                    <th>Kode Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga satuan</th>
                                    <th>Harga total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $penjualan = $model["penjualan"];
                                        
                                        $iteration = 0;
                                        foreach($penjualan as $row) :
                                            $iteration++;
                                    ?>
                                    <tr>
                                        <td><?= $iteration ?></td>
                                        <td><?= $row["tanggal_faktur"] ?? "-" ?></td>
                                        <td><?= $row["no_faktur"] ?? "-" ?></td>
                                        <td><?= $row["nama_konsumen"] ?? "-" ?></td>
                                        <td><?= $row["kode_barang"] ?? "-" ?></td>
                                        <td><?= $row["jumlah"] ?? "-" ?></td>
                                        <td><?= $row["harga_satuan"] ?? "-" ?></td>
                                        <td><?= $row["harga_total"] ?? "-" ?></td>
                                        
                                    </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php require __DIR__ . "/../layouts/bodyscripts.php" ?>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
$(document).ready(function() {


    $(".button-create").click(function() {
        $(".button-save").text("Tambah").removeClass("btn-warning").addClass("btn-success").attr("name", "create_penjualan");
        $("#penjualanModalLabel").text("Tambah Penjualan");
    });


});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2({
            placeholder: "Pilih Kode Barang",
            allowClear: true
        });
    });
</script>
</body>
</html>
