<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sparepart</title>
    <?php require __DIR__ . "/../layouts/headlinks.php" ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">

<?php
    use Akhfih\Sparepart\App\FlashMessage;
    FlashMessage::flashMessage();
?>
    
<div class="wrapper">
    <?php require __DIR__ . "/../layouts/nav-aside.php"; ?>

    <!-- Modal -->
    <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
        <!-- form start -->
        <form action="/barang" method="post" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barangModalLabel">Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kode">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?= $_SESSION["form-input"]["kode_barang"] ?? "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="<?= $_SESSION["form-input"]["nama_barang"] ?? "" ?>"  required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_sks">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" id="harga_jual" value="<?= $_SESSION["form-input"]["harga_jual"] ?? "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_sks">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" id="harga_beli" value="<?= $_SESSION["form-input"]["harga_beli"] ?? "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Satuan</label>
                                <input type="text" name="satuan" class="form-control" id="satuan" value="<?= $_SESSION["form-input"]["satuan"] ?? "" ?>"  required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Kategori</label>
                                <input type="text" name="kategori" class="form-control" id="kategori" value="<?= $_SESSION["form-input"]["kategori"] ?? "" ?>"  required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="create_barang" class="btn btn-success button-save">Tambah</button>
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
                        <h1>Barang Sparepart</h1>
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
								<h3 class="card-title">Barang Sparepart</h3>
								<a class="btn btn-success ml-auto button-create" data-toggle="modal" data-target="#barangModal">Tambah Barang</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $iteration = 0;
                                        foreach($model as $row) :
                                            $iteration++;
                                    ?>
                                    <tr>
                                        <td><?= $iteration ?></td>
                                        <td><?= $row["kode_barang"] ?></td>
                                        <td><?= $row["nama_barang"] ?></td>
                                        <td><?= $row["harga_jual"] ?></td>
                                        <td><?= $row["harga_beli"] ?></td>
                                        <td><?= $row["satuan"] ?></td>
                                        <td><?= $row["kategori"] ?></td>
                                        <td>
                                            <button data-id="<?= $row["id"] ?>" data-toggle="modal" data-target="#barangModal" class="btn btn-sm btn-warning button-edit">Ubah</button>
                                            
                                            <form action="/barang/delete/<?= $row["id"] ?>" method="post" class="form-delete d-inline-block">
												<button type="submit" class="btn btn-sm btn-danger button-delete">Hapus</button>
											</form>
                                        </td>
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
   
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $(".form-delete").on("submit", function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "kamu tidak bisa kembali setelah ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus sekarang!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).unbind("submit").submit();
            } else {
                Swal.fire({
                    title: 'Batal!',
                    text: 'Barang tidak jadi dihapus.',
                    icon: 'success',
                    timer: 4000
                });
            }
        });
    });

    $(".button-create").click(function() {
        $(".button-save").text("Tambah").removeClass("btn-warning").addClass("btn-success").attr("name", "create_barang");
        $("#barangModalLabel").text("Tambah Barang");
    });

    $(".button-edit").click(function() {
        // Reset form
        $("#modal-form").attr("action", "/barang");
        $("#modal-form")[0].reset();
        
        $.get("/barang/" + $(this).data("id"), function(response) {
            let data;
            try {
                data = JSON.parse(response);
                if(data.error) {
                    // Jika ada error
                } else {
                    // Set value dan action form
                    $("#modal-form").attr("action", "/barang/" + data.id);
                    $("#kode_barang").val(data.kode_barang);
                    $("#nama_barang").val(data.nama_barang);
                    $("#harga_jual").val(data.harga_jual);
                    $("#harga_beli").val(data.harga_beli);
                    $("#satuan").val(data.satuan);
                    $("#kategori").val(data.kategori);
                }
            } catch (exception) {
                // Jika tidak ada respon dari server
            }
            $(".button-save").text("Ubah").removeClass("btn-success").addClass("btn-warning").attr("name", "edit_barang");
            $("#barangModalLabel").text("Ubah Barang");
            $("#barangModal").modal("show");
        });
    });

    // Clear form saat modal edit close dan cek atribut name button-save
    $("#barangModal").on('hidden.bs.modal', function() {
        if($(".button-save").attr("name") == "edit_barang") {
            $("#modal-form").attr("action", "/barang");
            $("#modal-form")[0].reset();
        }
        $(".button-save").attr("name", "create_barang");
    });
});
</script>
</body>
</html>
