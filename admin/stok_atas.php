<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT produk.*, stock.* FROM produk LEFT JOIN stock on stock.idproduk = produk.idproduk where month (stock.tanggal_stock) in ('$request') Order BY id_stock desc");
    $row = mysqli_num_rows($cek);

    $totalmasuk = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahmasuk FROM stock where status_stock = 1 AND month (tanggal_stock) in ('$request')");
    $cekrow = mysqli_num_rows($totalmasuk);
    $jumlahmasuk = mysqli_fetch_assoc($totalmasuk);
    $jumlah1 = $jumlahmasuk['jumlahmasuk'];
    $totalkeluar = mysqli_query($conn, "SELECT SUM(jumlah_stock) as jumlahkeluar FROM stock where status_stock = 2 AND month (tanggal_stock) in ('$request')");
    $cekrow2 = mysqli_num_rows($totalkeluar);
    $jumlahkeluar = mysqli_fetch_assoc($totalkeluar);
    $jumlah2 = $jumlahkeluar['jumlahkeluar'];
    $total = $jumlah1 - $jumlah2;


?>

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
                                    echo ($jumlah1);
                                    ?></h4>
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
                <h4 class="1"><?php echo ($jumlah2); ?></h4>
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
                <h4 class="1"><?php echo ($total);
                                    ?></h4>
            </div>
        </div>
    </div>
</div>

</div>

<?php
} ?>