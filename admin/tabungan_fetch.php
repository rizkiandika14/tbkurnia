<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT tabungan.id as idtabungan, pelanggan.idpelanggan, tabungan.total, pelanggan.telepon_pelanggan, pelanggan.nama_pelanggan, tabungan.tgltransaksi, tabungan.catatan from pelanggan inner join tabungan on tabungan.idpelanggan = pelanggan.idpelanggan where pelanggan.telepon_pelanggan != '-' AND month(tabungan.tgltransaksi) in ('$request') ORDER BY tabungan.id asc ");
    $row = mysqli_num_rows($cek);
    function ribuan($nilai)
    {
        return number_format($nilai, 0, ',', '.');
    }
?>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="example1" width="100%">

    <?php
        if ($row) {

        ?>
    <thead>
        <tr>
            <th>No.</th>
            <th>Pelanggan</th>
            <th>No Member</th>
            <th>Total</th>
            <th>Catatan</th>
            <th>Tanggal Input</th>
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
                while ($d = mysqli_fetch_array($cek)) {
                    $idtabungan = $d['idtabungan'];
                ?>

        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $d['nama_pelanggan'] ?></td>
            <td><?php echo $d['telepon_pelanggan'] ?></td>
            <td>Rp.<?php echo ribuan($d['total']) ?></td>
            <td class="catatan"><?php echo $d['catatan'] ?></td>
            <td><?php echo $d['tgltransaksi'] ?></td>
            <td><a class="btn btn-danger btn-xs" href="?hapus=<?php echo $idtabungan ?>"
                    onclick="javascript:return confirm('Hapus Data tabungan - <?php echo $d['nama_pelanggan'] ?> ?');">
                    <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#example1').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [


            {
                extend: 'excel',
                text: 'Excel',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }


        ]
    });
});
</script>