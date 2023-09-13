<?php include 'template/header_laporan.php'; ?>
<br>
<div class="row laporan-atas">
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
                                    $itungpelanggan = mysqli_query($conn, "SELECT COUNT(idpelanggan) as jumlahpelanggan FROM pelanggan");
                                    $cekrow1 = mysqli_num_rows($itungpelanggan);
                                    $itungpelanggan1 = mysqli_fetch_assoc($itungpelanggan);
                                    $itungpelanggan2 = $itungpelanggan1['jumlahpelanggan'];
                                    if ($cekrow1 > 0) {
                                        echo  $itungpelanggan2;
                                    } ?></h4>
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
                    <h4 class="1"><?php $itungpeterjual = mysqli_query($conn, "SELECT SUM(quantity) as jumlahterjual FROM tb_nota");
                                    $cekrow = mysqli_num_rows($itungpeterjual);
                                    $itungpeterjual1 = mysqli_fetch_assoc($itungpeterjual);
                                    $itungpeterjual2 = $itungpeterjual1['jumlahterjual'];
                                    if ($cekrow > 0) {
                                        echo $itungpeterjual2;
                                    } ?></h4>
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
                                        $data_produk = mysqli_query($conn, "SELECT * FROM tb_nota t, produk p
                    WHERE p.idproduk=t.idproduk ORDER BY idnota ASC");
                                        $subtotaldiskon = 0;
                                        $x = mysqli_num_rows($data_produk);
                                        $itungdiskon = mysqli_query($conn, "SELECT SUM(diskon) as disc FROM laporan");
                                        $cekrow5 = mysqli_num_rows($itungdiskon);
                                        $itungdiskon1 = mysqli_fetch_assoc($itungdiskon);
                                        $itungdiskon2 = $itungdiskon1['disc'];
                                        if ($x > 0) {
                                            while ($b = mysqli_fetch_array($data_produk)) {
                                                $totalharga += $b['harga_jual'] * $b['quantity'];
                                                $totaldiskon += $b['harga_modal'] * $b['quantity'];
                                                $subtotaldiskon = $totalharga - $totaldiskon;
                                            }
                                        }
                                        $totalll = $subtotaldiskon - $itungdiskon2;
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
                                        $itungtotal = mysqli_query($conn, "SELECT SUM(totalbeli) as jumlahtotal FROM laporan");
                                        $cekrow3 = mysqli_num_rows($itungtotal);
                                        $itungtotal1 = mysqli_fetch_assoc($itungtotal);
                                        $itungtotal2 = $itungtotal1['jumlahtotal'];
                                        $itungdiskon = mysqli_query($conn, "SELECT SUM(diskon) as disc FROM laporan");
                                        $cekrow5 = mysqli_num_rows($itungdiskon);
                                        $itungdiskon1 = mysqli_fetch_assoc($itungdiskon);
                                        $itungdiskon2 = $itungdiskon1['disc'];
                                        $itungg = $itungtotal2 - $itungdiskon2;
                                        if ($cekrow3 > 0) {
                                            echo ribuan($itungg);
                                        } ?></h4>
                </div>
            </div>
        </div>
    </div>

</div><!-- end row -->
<div class="card">
    <div class="card-header">
        <div class="card-tittle">
            <i class="fa fa-table me-2"></i> Data Laporan Transaksi
            <div class="float-right">
                <label for="" class="badge badge-primary">Filter Bulan</label><br>
                <select name="bulan" id="bulan">
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

</div>
<br>


<!-- end box print -->


<div class="card-body laporan-wrapper">


    <table class="table table-striped table-sm table-bordered dt-responsive nowrap print-none" id="laporan_table"
        width="100%">

        <thead>
            <tr>
                <th>No.</th>
                <th>No. Nota</th>
                <th>Pelanggan</th>
                <th>Qty</th>
                <th>Catatan</th>
                <th>SubTotal</th>
                <th>Diskon</th>
                <th>Pembayaran</th>
                <th>Kembalian</th>
                <th>Tanggal</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data_produk = mysqli_query($conn, "SELECT * FROM laporan l, pelanggan e
                                WHERE  e.idpelanggan=l.idpelanggan");
            while ($d = mysqli_fetch_array($data_produk)) {
                $idlaporan = $d['idlaporan'];
                $nota = $d['no_nota'];
            ?>

            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $d['no_nota'] ?></td>
                <td><?php echo $d['nama_pelanggan'] ?></td>
                <td><?php
                        $itungtrans = mysqli_query($conn, "SELECT SUM(quantity) as jumlahtrans
                                             FROM tb_nota where no_nota='$nota'");
                        $itungtrans2 = mysqli_fetch_assoc($itungtrans);
                        $itungtrans3 = $itungtrans2['jumlahtrans'];
                        echo $itungtrans3;
                        ?></td>
                <td class="catatan"><?php echo $d['catatan'] ?></td>
                <td>Rp.<?php echo ribuan($d['totalbeli']) ?></td>
                <td>Rp.<?php echo ribuan($d['diskon']) ?></td>
                <td>Rp.<?php echo ribuan($d['pembayaran']) ?></td>
                <td>Rp.<?php echo ribuan($d['kembalian']) ?></td>
                <td><?php echo $d['tgl_sub'] ?></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="detail.php?invoice=<?php echo $nota ?>">
                        <i class="fa fa-eye fa-xs mr-1"></i>View</a>
                    <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $nota ?>"
                        onclick="javascript:return confirm('Hapus Data laporan - <?php echo $d['no_nota'] ?> ?');">
                        <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>
            <?php } ?>

            <!-- <tr>

            <th>Pendapatan : </th>
            <th>Rp.
                <?php echo ribuan($subtotaldiskon) ?></th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th></th>
        </tr>
        <tr>

            <th><b>Total :
                </b></th>
            <th>
                <b>Rp. <?php
                        echo ribuan($itungtotal2);
                        ?>
                </b>
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr> -->
        </tbody>
        <tfoot>
            <tr>
                <th>Pendapatan :</th>

                <th>Rp.
                    <?php echo ribuan($totalll) ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total :</th>
                <th><?php
                    echo ribuan($itungg);
                    ?></th>
                <th></th>
            </tr>

        </tfoot>

    </table>
</div>

</div>




<?php
if (!empty($_GET['hapus'])) {
    $nota = $_GET['hapus'];
    $hapus_data = mysqli_query($conn, "DELETE FROM laporan WHERE no_nota='$nota'");
    $hapus_data1 = mysqli_query($conn, "DELETE FROM tb_nota WHERE no_nota='$nota'");
    if ($hapus_data && $hapus_data1) {
        echo '<script>alert("Berhasi Hapus data laporan");window.location="laporan.php"</script>';
    } else {
        echo '<script>alert("gagal Hapus data laporan");history.go(-1);</script>';
    }
};
?>



<?php include 'template/footer.php'; ?>