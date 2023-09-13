<?php
if (isset($_POST['tambahProduk'])) {
    $idkategori = htmlspecialchars($_POST['idkategori']);
    $kodeproduk = htmlspecialchars($_POST['kode_produk']);
    $namaproduk = htmlspecialchars($_POST['nama_produk']);

    $harga_modal = htmlspecialchars($_POST['harga_modal']);
    $harga_jual = htmlspecialchars($_POST['harga_jual']);
    $satuan = htmlspecialchars($_POST['satuan']);
    $detail_produk = htmlspecialchars($_POST['detail_produk']);

    $tambahkat = mysqli_query($conn, "INSERT INTO produk (idkategori,kode_produk,nama_produk,stock,harga_modal,harga_jual, satuan, detail)
                 values ('$idkategori','$kodeproduk','$namaproduk','0','$harga_modal','$harga_jual','$satuan','$detail_produk')");
    if ($tambahkat) {
        $query = mysqli_query($conn, "SELECT max(idproduk) as kodeTerbesar FROM produk");
        $data = mysqli_fetch_array($query);
        $idproduk = $data['kodeTerbesar'];
        $tambahstok = mysqli_query($conn, "INSERT INTO stock (idproduk,status_stock,jumlah_stock)
                 values ('$idproduk','1','0')");
        echo '<script>alert("Berhasil Menambahkan Data");window.location="produk.php"</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
};

if (isset($_POST['updateProduk'])) {
    $idproduk = htmlspecialchars($_POST['idproduk1']);
    $idkategori = htmlspecialchars($_POST['idkategori1']);
    $kodeproduk = htmlspecialchars($_POST['kode_produk1']);
    $namaproduk = htmlspecialchars($_POST['nama_produk1']);

    $harga_modal = htmlspecialchars($_POST['harga_modal1']);
    $harga_jual = htmlspecialchars($_POST['harga_jual1']);
    $satuan = htmlspecialchars($_POST['satuan1']);
    $detail_produk = htmlspecialchars($_POST['detail_produk1']);

    $updateproduk = mysqli_query($conn, "UPDATE produk SET
                idkategori='$idkategori',nama_produk='$namaproduk',kode_produk='$kodeproduk',
                harga_modal='$harga_modal',harga_jual='$harga_jual',satuan='$satuan',detail='$detail_produk' WHERE idproduk='$idproduk' ");
    if ($updateproduk) {
        echo '<script>alert("Berhasil Update produk");window.location="produk.php"</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
};

if (isset($_POST['tambahStock'])) {
    $idproduk = htmlspecialchars($_POST['idproduk']);
    $jumlah_stock = htmlspecialchars($_POST['jumlah_stock']);
    $status_stock = htmlspecialchars($_POST['status_stock']);

    $tambahstok = mysqli_query($conn, "INSERT INTO stock (idproduk,status_stock,jumlah_stock)
                 values ('$idproduk','1','$jumlah_stock')");
    if ($tambahstok) {
        $cekBarang1 = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk='$idproduk'");
        $stocknya1  = mysqli_fetch_array($cekBarang1);
        $stockk     = $stocknya1['stock'];
        //menghitung sisa stok
        $sisa1      = $stockk + $jumlah_stock;
        mysqli_query($conn, "UPDATE produk SET stock='$sisa1' WHERE idproduk='$idproduk'");
        echo '<script>alert("Berhasil Menambahkan Data");window.location="produk.php"</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
};

if (isset($_POST['tambahSatuan'])) {
    $satuan = htmlspecialchars($_POST['satuan']);

    $tambahsatuan = mysqli_query($conn, "INSERT INTO tb_satuan (satuan)
                 values ('$satuan')");
    if ($tambahsatuan) {
        echo '<script>alert("Berhasil Menambahkan Data");window.location="produk.php"</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
};
?>
<?php
if (!empty($_GET['hapus'])) {
    $idproduk = $_GET['hapus'];
    $hapus_data = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idproduk'");
    if ($hapus_data) {
        echo '<script>alert("Berhasil Hapus Data Produk");window.location="produk.php"</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
    }
};
?>

<!-- Modal -->
<div class="modal fade" id="addproduk" tabindex="-1" role="dialog" aria-labelledby="ModalTittle" aria-hidden="true">
    <?php
    $query = mysqli_query($conn, "SELECT max(kode_produk) as kodeTerbesar FROM produk");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeBarang, 3, 3);
    $urutan++;
    $huruf = "BRG";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTittle"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Tambah
                        Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Kode Produk :</label>
                        <input type="text" name="kode_produk" class="form-control" value="<?php echo $kodeBarang; ?>"
                            readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label>Nama Produk :</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Detail Produk (Merk) :</label>
                        <input type="text" name="detail_produk" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Kategori Produk :</label>
                        <select name="idkategori" class="form-control" required>
                            <?php
                            $dataK = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                            while ($dk = mysqli_fetch_array($dataK)) {
                            ?>
                            <option value="<?php echo $dk['idkategori'] ?>" class="small">
                                <?php echo $dk['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Satuan :</label>
                        <select name="satuan" class="form-control" required>
                            <?php
                            $dataK = mysqli_query($conn, "SELECT * FROM tb_satuan ORDER BY satuan ASC");
                            while ($dk = mysqli_fetch_array($dataK)) {
                            ?>
                            <option value="<?php echo $dk['satuan'] ?>" class="small">
                                <?php echo $dk['satuan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <!-- <div class="col-2 col-md-2 pr-0">
                            <label>Stock :</label>
                            <input type="hidden" value="0" name="stock" class="form-control" required>
                        </div> -->
                        <div class="col-6 col-md-6 pr-0">
                            <label>Harga Modal :</label>
                            <input type="number" name="harga_modal" class="form-control" required>
                        </div>
                        <div class="col-6 col-md-6">
                            <label>Harga Jual :</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> Batal</button>
                    <button type="reset" class="btn btn-danger btn-xs p-2">
                        <i class="fa fa-trash-restore-alt mr-1"></i> Reset</button>
                    <button type="submit" class="btn btn-primary btn-xs p-2" name="tambahProduk">
                        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Stok-->
<div class="modal fade" id="addstok" tabindex="-1" role="dialog" aria-labelledby="ModalTittle" aria-hidden="true">
    <?php
    $query = mysqli_query($conn, "SELECT max(kode_produk) as kodeTerbesar FROM produk");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeBarang, 3, 3);
    $urutan++;
    $huruf = "BRG";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTittle"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Tambah
                        Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label>Nama Produk :</label>
                        <select name="idproduk" class="form-control" required>
                            <?php
                            $dataK = mysqli_query($conn, "SELECT * FROM produk ORDER BY nama_produk ASC");
                            while ($dk = mysqli_fetch_array($dataK)) {
                            ?>
                            <option value="<?php echo $dk['idproduk'] ?>" class="small">
                                <?php echo $dk['nama_produk'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Jumlah Produk :</label>
                        <input type="number" name="jumlah_stock" class="form-control" required>
                    </div>
                    <!--<div class="form-group mb-2">-->
                    <!--    <label>Jenis :</label>-->
                    <!--    <select type="text" class="form-control form-control-sm bg-white" name="status_stock"-->
                    <!--        id='status_stock'>-->
                    <!--        <option value='1'>Barang Masuk</option>-->

                    <!--    </select>-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> Batal</button>
                    <button type="reset" class="btn btn-danger btn-xs p-2">
                        <i class="fa fa-trash-restore-alt mr-1"></i> Reset</button>
                    <button type="submit" class="btn btn-primary btn-xs p-2" name="tambahStock">
                        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Stok-->
<div class="modal fade" id="addsatuan" tabindex="-1" role="dialog" aria-labelledby="ModalTittle" aria-hidden="true">
    <?php
    $query = mysqli_query($conn, "SELECT max(kode_produk) as kodeTerbesar FROM produk");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeBarang, 3, 3);
    $urutan++;
    $huruf = "BRG";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTittle"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Tambah
                        Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Satuan :</label>
                        <input type="text" name="satuan" class="form-control" required>
                    </div>
                    <!--<div class="form-group mb-2">-->
                    <!--    <label>Jenis :</label>-->
                    <!--    <select type="text" class="form-control form-control-sm bg-white" name="status_stock"-->
                    <!--        id='status_stock'>-->
                    <!--        <option value='1'>Barang Masuk</option>-->

                    <!--    </select>-->
                    <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> Batal</button>
                    <button type="reset" class="btn btn-danger btn-xs p-2">
                        <i class="fa fa-trash-restore-alt mr-1"></i> Reset</button>
                    <button type="submit" class="btn btn-primary btn-xs p-2" name="tambahSatuan">
                        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>