<?php include 'template/header_laporan.php'; ?>

<br>
<!-- <div class="row produk-atas">
    <div class="col-8 col-sm-8 col-md-8 col-lg-3 mb-3 pr-0">
        <div class="card-body bg-white py-2 px-1 border-laporan">
            <div class="row mx-auto align-items-center">
                <div class="col-auto m-pr-1">
                    <div class="bg-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>
                <div class="col-auto pl-0 pt-2">
                    <div class="text-muted" style="font-size:11px;">
                        Produk
                    </div>
                    <h4 class="1"><?php

                                    $totalproduk = mysqli_query($conn, "SELECT COUNT(idproduk) as jumlahproduk FROM produk");
                                    $cekrow = mysqli_num_rows($totalproduk);
                                    $jumlahproduk = mysqli_fetch_assoc($totalproduk);
                                    $jumlah11 = $jumlahproduk['jumlahproduk'];

                                    if ($cekrow > 0) {
                                        echo ($jumlah11);
                                    } else {
                                        0;
                                    } ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 col-sm-8 col-md-8 col-lg-3 mb-3 pr-0">
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
    <div class="col-8 col-sm-8 col-md-8 col-lg-3 mb-3 pr-0">
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
    <div class="col-8 col-sm-8 col-md-8 col-lg-3 mb-3 pr-0">
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

</div> -->
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Laporan Produk
            <div class="float-right">
                <label for="" class="badge badge-primary">Filter Bulan</label><br>
                <select name="bulan_produk" id="bulan_produk">
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
    <div class="card-body produk-wrapper">

        <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="produk_table" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Detail Produk</th>
                    <th>Kategori</th>
                    <th>Stock Masuk</th>
                    <th>Stock Keluar</th>
                    <th>Stock</th>
                    <th>Satuan</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data_produk = mysqli_query($conn, "SELECT kategori.*,stock.*,produk.* FROM kategori JOIN produk ON kategori.idkategori=produk.idkategori INNER JOIN stock ON produk.idproduk=stock.idproduk group by produk.idproduk ASC");
                while ($d = mysqli_fetch_array($data_produk)) {
                    $idproduk = $d['idproduk'];
                ?>

                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $d['kode_produk'] ?></td>
                    <td><?php echo $d['nama_produk'] ?></td>
                    <td><?php echo $d['detail'] ?></td>
                    <td><?php echo $d['nama_kategori'] ?></td>
                    <td><?php
                            $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1 AND idproduk = $idproduk ");
                            $cekrow = mysqli_num_rows($totalmasuk);
                            $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
                            $jumlah1 = $jumlahmasuk['jumlahmasuk'];
                            if ($cekrow > 0) {
                                echo ($jumlah1);
                            } ?></td>
                    <td><?php
                            $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2  AND idproduk = $idproduk");
                            $cekrow2 = mysqli_num_rows($totalkeluar);
                            $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
                            $jumlah2 = $jumlahkeluar['jumlahkeluar'];
                            if ($cekrow > 0) {
                                echo ($jumlah2);
                            } ?></td>
                    <td><?php echo $d['stock'] ?></td>
                    <td><?php echo $d['satuan'] ?></td>
                    <td>Rp.<?php echo ribuan($d['harga_modal']) ?></td>
                    <td>Rp.<?php echo ribuan($d['harga_jual']) ?></td>
                    <td><?php echo $d['tgl_input'] ?></td>

                </tr>


                <!-- end modal edit -->
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
<?php include 'template/footer.php'; ?>