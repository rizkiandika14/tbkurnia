<?php include 'template/header.php'; ?>

<br>
<div class="row">
    <div class="col-8 col-sm-8 col-md-8 col-lg-4 mb-4 pr-0">
        <div class="card-body bg-white py-2 px-1 border-laporan">
            <div class="row mx-auto align-items-center">
                <div class="col-auto m-pr-1">
                    <div class="bg-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="col-auto pl-0 pt-2">
                    <div class="text-muted" style="font-size:11px;">
                        Barang Masuk
                    </div>
                    <h4 class="1"><?php
                                    $id = $_GET['idproduk'];
                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where idproduk = $id AND status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where idproduk = $id AND status_stock = 2");
                                    $cekrow2 = mysqli_num_rows($totalkeluar);
                                    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                                    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                                    $total = $jumlah1 - $jumlah2;
                                    if ($cekrow > 0) {
                                        echo ($jumlah1);
                                    } else {
                                        0;
                                    } ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 col-sm-8 col-md-8 col-lg-4 mb-4 pr-0">
        <div class="card-body bg-white py-2 px-1 border-laporan">
            <div class="row mx-auto align-items-center">
                <div class="col-auto m-pr-1">
                    <div class="bg-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="col-auto pl-0 pt-2">
                    <div class="text-muted" style="font-size:11px;">
                        Barang Keluar
                    </div>
                    <h4 class="1"><?php
                                    $id = $_GET['idproduk'];
                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where idproduk = $id AND status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where idproduk = $id AND status_stock = 2");
                                    $cekrow2 = mysqli_num_rows($totalkeluar);
                                    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                                    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                                    $total = $jumlah1 - $jumlah2;
                                    if ($cekrow > 0) {
                                        echo ($jumlah2);
                                    } else {
                                        0;
                                    } ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 col-sm-8 col-md-8 col-lg-4 mb-4 pr-0">
        <div class="card-body bg-white py-2 px-1 border-laporan">
            <div class="row mx-auto align-items-center">
                <div class="col-auto m-pr-1">
                    <div class="bg-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="col-auto pl-0 pt-2">
                    <div class="text-muted" style="font-size:11px;">
                        Stock Tersedia
                    </div>
                    <h4 class="1"><?php
                                    $id = $_GET['idproduk'];
                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where idproduk = $id AND status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where idproduk = $id AND status_stock = 2");
                                    $cekrow2 = mysqli_num_rows($totalkeluar);
                                    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                                    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                                    $total = $jumlah1 - $jumlah2;
                                    if ($cekrow > 0) {
                                        echo ($total);
                                    } else {
                                        0;
                                    } ?></h4>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Data Stok Produk
            <!--<button type="button" class="btn btn-primary btn-xs p-2 float-right" data-toggle="modal"-->
            <!--    data-target="#addstok">-->
            <!--    <i class="fa fa-plus fa-xs mr-1"></i> Tambah Stok</button>-->
        </div>
    </div>
    <div class="card-body">

        <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php include
                    $id = $_GET['idproduk'];
                $data_produk = mysqli_query($conn, "SELECT produk.*, stock.* FROM produk LEFT JOIN stock on stock.idproduk = produk.idproduk WHERE produk.idproduk=$id Order BY id_stock desc");
                $no = 1;
                while ($data = mysqli_fetch_array($data_produk)) {
                ?>


                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['kode_produk'] ?></td>
                    <td><?php echo $data['nama_produk'] ?></td>
                    <td><?php echo $data['jumlah_stock'] ?></td>
                    <td> <?php if ($data['status_stock'] == 1) : ?>
                        <span class="badge badge-success">Barang Masuk</span>
                        <?php elseif ($data['status_stock'] == 2) : ?>
                        <span class="badge badge-warning">Barang Keluar</span>
                        <?php else : ?>
                        <span class="badge badge-danger">Error</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $data['tanggal_stock'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total Stock : </td>
                    <td colspan="3"><?php
                                    $id = $_GET['idproduk'];
                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where idproduk = $id AND status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where idproduk = $id AND status_stock = 2");
                                    $cekrow2 = mysqli_num_rows($totalkeluar);
                                    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                                    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                                    $total = $jumlah1 - $jumlah2;
                                    if ($cekrow > 0) {
                                        echo ($total);
                                    } ?></td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<?php include 'template/footer.php'; ?>