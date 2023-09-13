<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT * FROM laporan l, pelanggan e
    WHERE  e.idpelanggan=l.idpelanggan AND month (l.tgl_sub) in ('$request') ORDER BY idlaporan ASC ");
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

    $itungtotal = mysqli_query($conn, "SELECT SUM(totalbeli) as jumlahtotal FROM laporan where month (tgl_sub) in ('$request')");
    $cekrow3 = mysqli_num_rows($itungtotal);
    $itungtotal1 = mysqli_fetch_assoc($itungtotal);
    $itungtotal2 = $itungtotal1['jumlahtotal'];
    $itungdiskon = mysqli_query($conn, "SELECT SUM(diskon) as disc FROM laporan where month (tgl_sub) in ('$request')");
    $cekrow5 = mysqli_num_rows($itungdiskon);
    $itungdiskon1 = mysqli_fetch_assoc($itungdiskon);
    $itungdiskon2 = $itungdiskon1['disc'];
    $itungg = $itungtotal2 - $itungdiskon2;
    $totalll = ($subtotaldiskon) - $itungdiskon2;
    function ribuan($nilai)
    {
        return number_format($nilai, 0, ',', '.');
    }
    $itungpeterjual = mysqli_query($conn, "SELECT SUM(quantity) as jumlahterjual FROM tb_nota t, laporan l WHERE l.no_nota = t.no_nota AND month (l.tgl_sub) in ('$request')");
    $cekrow = mysqli_num_rows($itungpeterjual);
    $itungpeterjual1 = mysqli_fetch_assoc($itungpeterjual);
    $itungpeterjual2 = $itungpeterjual1['jumlahterjual'];

    $itungpelanggan = mysqli_query($conn, "SELECT Count(idpelanggan) as jumlahpelanggan FROM pelanggan");
    $cekrow1 = mysqli_num_rows($itungpelanggan);
    $itungpelanggan1 = mysqli_fetch_assoc($itungpelanggan);
    $itungpelanggan2 = $itungpelanggan1['jumlahpelanggan'];


?>
<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3 pr-0">
    <div class="card-body bg-white py-2 px-1 border-laporan">
        <div class="row mx-auto align-items-center">
            <div class="col-auto m-pr-1">
                <div class="bg-icon">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="col-auto pl-0 pt-2">
                <div class="text-muted" style="font-size:11px;">
                    Pelanggan
                </div>
                <h4 class="1"><?php
                                    echo  $itungpelanggan2;
                                    ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3 m-pr-0">
    <div class="card-body bg-white py-2 px-1 border-laporan">
        <div class="row mx-auto align-items-center">
            <div class="col-auto m-pr-1">
                <div class="bg-icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
            <div class="col-auto pl-0 pt-2">
                <div class="text-muted" style="font-size:11px;">
                    Terjual
                </div>
                <h4 class="1"> <?php
                                    echo $itungpeterjual2;
                                    ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3 pr-0">
    <div class="card-body bg-white py-2 px-1 border-laporan">
        <div class="row mx-auto align-items-center">
            <div class="col-auto m-pr-1">
                <div class="bg-icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
            <div class="col-auto pl-0 pt-2">
                <div class="text-muted" style="font-size:11px;">
                    Pendapatan
                </div>
                <h4 class="1">Rp.<?php
                                        echo ribuan($totalll) ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-3">
    <div class="card-body bg-white py-2 px-1 border-laporan">
        <div class="row mx-auto align-items-center">
            <div class="col-auto m-pr-1">
                <div class="bg-icon">
                    <i class="fa fa-file-invoice-dollar"></i>
                </div>
            </div>
            <div class="col-auto pl-0 pt-2">
                <div class="text-muted" style="font-size:11px;">
                    Total
                </div>
                <h4 class="1">Rp.<?php
                                        echo ribuan($itungg);
                                        ?></h4>
            </div>
        </div>
    </div>
</div>

</div><!-- end row -->

<?php
} ?>