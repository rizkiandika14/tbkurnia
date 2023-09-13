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
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal Input</th>
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
                while ($data = mysqli_fetch_array($cek)) {

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
                        echo ($total); ?></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
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