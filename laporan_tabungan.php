<?php include 'template/header_laporan.php'; ?>
<br>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2 d-none d-sm-inline-block d-md-inline-block"></i> Laporan
            Tabungan

        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="example1" width="100%">
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
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data_produk = mysqli_query($conn, "SELECT tabungan.id as idtabungan, pelanggan.idpelanggan, tabungan.total, pelanggan.telepon_pelanggan, pelanggan.nama_pelanggan, tabungan.tgltransaksi, tabungan.catatan from pelanggan inner join tabungan on tabungan.idpelanggan = pelanggan.idpelanggan where pelanggan.telepon_pelanggan != '-' ORDER BY tabungan.id asc");
                while ($d = mysqli_fetch_array($data_produk)) {
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
    </div>
</div>
<?php
if (!empty($_GET['hapus'])) {
    $idtabungan = $_GET['hapus'];
    $hapus_data = mysqli_query($conn, "DELETE FROM tabungan WHERE id='$idtabungan'");
    if ($hapus_data) {
        echo '<script>alert("Berhasil Hapus Data Tabungan");window.location="laporan_tabungan.php"</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Tabungan");history.go(-1);</script>';
    }
};
?>

<?php include 'template/footer.php'; ?>