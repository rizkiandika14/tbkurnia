<?php include 'template/header_laporan.php'; ?>

<br>
<div class="row stok-atas">
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

                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2");
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

                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2");
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

                                    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1");
                                    $cekrow = mysqli_num_rows($totalmasuk);
                                    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                                    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                                    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2");
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
            <div class="float-right">
                <label for="" class="badge badge-primary">Filter Bulan</label><br>
                <select name="bulan_stok" id="bulan_stok">
                    <option value="01','02','03','04','05','06','07','08','09','10','11','12">--Semua--</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>


            </div>
        </div>
    </div>
    <div class="card-body stok-wrapper">

        <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="example1" width="100%">
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
                <?php
                $data_produk = mysqli_query($conn, "SELECT produk.*, stock.* FROM produk LEFT JOIN stock on stock.idproduk = produk.idproduk Order BY id_stock desc");
                $no = 1;
                while ($data = mysqli_fetch_array($data_produk)) {
                ?>


                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><a href="stok.php?idproduk=<?= $data['idproduk'] ?>"><?php echo $data['kode_produk'] ?></a></td>
                    <td><a href="stok.php?idproduk=<?= $data['idproduk'] ?>"><?php echo $data['nama_produk'] ?></a></td>
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
                    <td>Total Stock : </td>
                    <td></td>
                    <td></td>
                    <td><?php

                        $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1");
                        $cekrow = mysqli_num_rows($totalmasuk);
                        $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                        $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                        $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2");
                        $cekrow2 = mysqli_num_rows($totalkeluar);
                        $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                        $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                        $total = $jumlah1 - $jumlah2;
                        if ($cekrow > 0) {
                            echo ($total);
                        } ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<?php include 'template/footer.php'; ?>