<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT kategori.*,stock.*,produk.* FROM kategori JOIN produk ON kategori.idkategori=produk.idkategori INNER JOIN stock ON produk.idproduk=stock.idproduk where month (produk.tgl_input) in ('$request') group by produk.idproduk ASC");
    $row = mysqli_num_rows($cek);

    $data_produk = mysqli_query($conn, "SELECT * FROM tb_nota t, produk p, laporan l WHERE p.idproduk=t.idproduk AND l.no_nota = t.no_nota AND month (l.tgl_sub) in ('$request') ORDER BY idnota ASC");
    $subtotaldiskon = 0;
    $x = mysqli_num_rows($data_produk);
    if ($x > 0) {
        while ($b = mysqli_fetch_array($data_produk)) {
            $totalharga += $b['harga_jual'] * $b['quantity'];
            $totaldiskon += $b['harga_modal'] * $b['quantity'];
            $subtotaldiskon = $totalharga - $totaldiskon;
        }
    }
    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1");
    $cekrow = mysqli_num_rows($totalmasuk);
    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2");
    $cekrow2 = mysqli_num_rows($totalkeluar);
    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
    $total = $jumlah1 - $jumlah2;
    $totalproduk = mysqli_query($conn, "SELECT COUNT(idproduk) as jumlahproduk FROM produk");
    $cekrow1 = mysqli_num_rows($totalproduk);
    $jumlahproduk = mysqli_fetch_assoc($totalproduk);
    $jumlah11 = $jumlahproduk['jumlahproduk'];


?>
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
                <h4 class="1"><?php echo ($jumlah11); ?></h4>
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
                <h4 class="1"><?php echo ($jumlah1); ?></h4>
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
                <h4 class="1"><?php echo ($jumlah2); ?></h4>
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
                <h4 class="1"><?php echo ($total); ?></h4>
            </div>
        </div>
    </div>
</div>

</div><!-- end row -->

<?php
} ?>