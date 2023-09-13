<?php
include "config.php";
if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $cek = mysqli_query($conn, "SELECT kategori.*,stock.*,produk.* FROM kategori JOIN produk ON kategori.idkategori=produk.idkategori INNER JOIN stock ON produk.idproduk=stock.idproduk where month (produk.tgl_input) in ('$request') group by produk.idproduk ASC");
    $row = mysqli_num_rows($cek);
    function ribuan($nilai)
    {
        return number_format($nilai, 0, ',', '.');
    }
?>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="produk_table" width="100%">

    <?php
        if ($row) {

        ?>
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
<?php } ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#produk_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [


            {
                extend: 'excel',
                text: 'Excel',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'pdf',
                text: 'Pdf',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            }


        ]
    });
});
</script>