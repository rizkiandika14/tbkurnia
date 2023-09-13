<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT * FROM laporan l, pelanggan e
    WHERE  e.idpelanggan=l.idpelanggan AND month (l.tgl_sub) in ('$request') ");
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
    $totalll = $subtotaldiskon - $itungdiskon2;
    function ribuan($nilai)
    {
        return number_format($nilai, 0, ',', '.');
    }


?>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap no-footer print-none" id="example"
    width="100%">

    <?php
        if ($row) {

        ?>
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

        <?php
        } else {
            echo "Data tidak ditemukan!";
        }
            ?>
    </thead>
    <tbody>
        <?php
                $no = 1;
                while ($row = mysqli_fetch_array($cek)) {
                    $idlaporan = $row['idlaporan'];
                    $nota = $row['no_nota'];
                ?>

        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['no_nota'] ?></td>
            <td><?php echo $row['nama_pelanggan'] ?></td>
            <td><?php $itungtrans = mysqli_query($conn, "SELECT SUM(quantity) as jumlahtrans
                                             FROM tb_nota where no_nota='$nota'");
                            $itungtrans2 = mysqli_fetch_assoc($itungtrans);
                            $itungtrans3 = $itungtrans2['jumlahtrans'];
                            echo ribuan($itungtrans3);
                            ?></td>
            <td> <?php echo $row['catatan'] ?></td>
            <td>Rp. <?php echo ribuan($row['totalbeli']) ?></td>
            <td>Rp. <?php echo ribuan($row['diskon']) ?></td>
            <td>Rp. <?php echo ribuan($row['pembayaran']) ?></td>
            <td>Rp. <?php echo ribuan($row['kembalian']) ?></td>
            <td> <?php echo $row['tgl_sub'] ?></td>
            <td>
                <a class="btn btn-primary btn-xs" href="detail.php?invoice=<?php echo $nota ?>">
                    <i class="fa fa-eye fa-xs mr-1"></i>View</a>
                <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $nota ?>"
                    onclick="javascript:return confirm('Hapus Data laporan - <?php echo $row['no_nota'] ?> ?');">
                    <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
            </td>
        </tr>
        <?php } ?>

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

<?php
} ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [


            {
                extend: 'excel',
                text: 'Excel',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }


        ]
    });
});
</script>