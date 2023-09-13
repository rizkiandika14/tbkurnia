<?php include 'template/header.php'; ?>
<?php
$bikin_nota = mysqli_query($conn, "SELECT max(no_nota) as kodeTerbesar11 FROM laporan");
$datanya = mysqli_fetch_array($bikin_nota);
$kodenota = $datanya['kodeTerbesar11'];
$urutan = (int) substr($kodenota, 9, 3);
$urutan++;
$tgl = date("jnyGi");
$huruf = "TB";
$kodeCart = $huruf . $tgl . sprintf("%03s", $urutan);
?>
</br>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2 d-none d-sm-inline-block d-md-inline-block"></i> Transaksi
            Tabungan
            <a href="laporan_tabungan.php">
                <button type="button" class="btn btn-primary btn-xs p-2 float-right">
                    <i class="fa fa-file fa-xs mr-1"></i> Laporan
                </button>
            </a>
        </div>
    </div>
    <div class="card-body">

        <div class="row mt-3">

            <div class="col-lg-3 mb-3">
                <div class="card small mb-3">
                    <div class="card-header p-2">
                        <div class="card-tittle"><i class="far fa-file mr-1"></i> Informasi Transaksi</div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-4 mb-2 text-right pt-1 pr-1">No.Tr : </div>
                            <div class="col-8 mb-2 pl-0">
                                <input type="text" class="form-control form-control-sm bg-white"
                                    value="<?php echo $kodeCart ?>" readonly>
                            </div>
                            <div class="col-4 mb-2 text-right pt-1 pr-1">Tanggal : </div>
                            <div class="col-8 mb-2 pl-0">
                                <input type="text" class="form-control form-control-sm bg-white" id="date-time"
                                    readonly>
                            </div>
                            <div class="col-4 text-right pt-1 pr-1">Kasir : </div>
                            <div class="col-8 pl-0">
                                <input type="text" class="form-control form-control-sm bg-white"
                                    value="<?php echo $user ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card small mb-3">
                    <div class="card-header p-2">
                        <div class="card-tittle"><i class="far fa-user mr-1"></i> Pelanggan Member
                            <a class="float-right" href="#" onclick="TambahBaru()">
                                Tambah Baru ?
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div style="display:none;width: 100%;" id="Tambah1">
                            <?php
                            if (isset($_POST['alamat_pelanggan'])) {
                                $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
                                $telepon_pelanggan = htmlspecialchars($_POST['telepon_pelanggan']);
                                $alamat_pelanggan = htmlspecialchars($_POST['alamat_pelanggan']);

                                $tambahPel = mysqli_query($conn, "INSERT INTO pelanggan(nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
                 values ('$nama_pelanggan','$telepon_pelanggan','$alamat_pelanggan')");
                                if ($tambahPel) {
                                    echo '<script>alert("Tambah Data Pelanggan Berhasil");window.location="index.php"</script>';
                                } else {
                                    echo '<script>alert("Maaf! data yang anda masukan salah.");history.go(-1);</script>';
                                }
                            };
                            ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-4 mb-2 text-right pt-1 pr-1 text-primary">Pelanggan : </div>
                                    <div class="col-8 mb-2 pl-0">
                                        <input type="text" class="form-control form-control-sm" name="nama_pelanggan"
                                            required>
                                    </div>
                                    <div class="col-4 mb-2 text-right pt-1 pr-1 text-primary">No member : </div>
                                    <div class="col-8 mb-2 pl-0">
                                        <input type="number" class="form-control form-control-sm"
                                            name="telepon_pelanggan" required>
                                    </div>
                                    <div class="col-4 text-right pt-1 pr-1 text-primary">Alamat : </div>
                                    <div class="col-8 pl-0">
                                        <input type="text" class="form-control form-control-sm" name="alamat_pelanggan"
                                            onchange="form.submit()" required>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end tambah1 -->
                        <div id="Ada1">
                            <div class="row">
                                <div class="col-4 mb-2 text-right pt-1 pr-1">Pelanggan : </div>
                                <div class="col-8 mb-2 pl-0">
                                    <?php
                                    $plgn = mysqli_query($conn, "SELECT * FROM pelanggan where telepon_pelanggan != '-' order by idpelanggan ASC");
                                    $jsArrayp = "var telepon_pelanggan = new Array();";
                                    $jsArrayp1 = "var alamat_pelanggan = new Array();";
                                    $jsArrayp2 = "var idpelanggan = new Array();";
                                    ?>
                                    <input type="text" class="form-control form-control-sm bg-white" list="datalist2"
                                        onchange="changeValuePelanggan(this.value)" id="mtd" name="mtd" required>
                                    <datalist id="datalist2">
                                        <?php
                                        if (mysqli_num_rows($plgn)) {
                                            while ($row_p = mysqli_fetch_array($plgn)) { ?>
                                        <option value="<?php echo $row_p["nama_pelanggan"] ?>">
                                            <?php echo $row_p["nama_pelanggan"] ?>
                                            <?php
                                                $jsArrayp .= "telepon_pelanggan['" . $row_p['nama_pelanggan'] . "'] = {telepon_pelanggan:'" . addslashes($row_p['telepon_pelanggan']) . "'};";
                                                $jsArrayp1 .= "alamat_pelanggan['" . $row_p['nama_pelanggan'] . "'] = {alamat_pelanggan:'" . addslashes($row_p['alamat_pelanggan']) . "'};";
                                                $jsArrayp2 .= "idpelanggan['" . $row_p['nama_pelanggan'] . "'] = {idpelanggan:'" . addslashes($row_p['idpelanggan']) . "'};";
                                            } ?>
                                            <?php } ?>
                                    </datalist>
                                </div>
                                <div class="col-4 mb-2 text-right pt-1 pr-1">No Member : </div>
                                <div class="col-8 mb-2 pl-0">
                                    <input type="text" class="form-control form-control-sm bg-white"
                                        id="telepon_pelanggan" readonly>
                                </div>
                                <div class="col-4 text-right pt-1 pr-1">Alamat : </div>
                                <div class="col-8 pl-0">
                                    <input type="text" class="form-control form-control-sm bg-white"
                                        id="alamat_pelanggan" readonly>
                                </div>
                            </div>
                        </div><!-- end ada1 -->
                    </div>
                </div>
            </div>

            <div class="col-lg-9" id="print">
                <form method="POST" class="mt-2 print-none">
                    <div class="" style="font-weight:500;">INPUT TABUNGAN</div>
                    <div class="row print-none">
                        <div class="col-6 col-lg-2 m-pr-0">
                            <label class="mb-1">Total</label>
                            <input type="text" class="form-control form-control-sm bg-white" name="total" required>
                        </div>
                    </div><!-- end row -->


                    <div class="row">
                        <div class="col-lg-7 mb-2">
                            <textarea name="catatan" class="form-control form-control-sm" id="catatan_baru"
                                placeholder="Catatan(Jika Ada)" cols="10" rows="5" required></textarea>
                        </div>
                        <div class="col-lg-5 mb-2 print-none">
                            <div class="row" style='display:none;'>
                                <input type="text" name="no_nota" value="<?php echo $kodeCart ?>">
                                <input type="text" name="idpelanggan" id="idpelanggan" required>
                            </div>
                            <div class="col-12 text-right pr-0 mt-2">
                                <button type="submit" name="save" class="btn btn-primary btn-sm px-3">
                                    <i class="far fa-file mr-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div><!-- end row -->
                    <div class="col-5 mb-2 text-left pt-1 pr-2 dtb" style="display:none;font-weight:500;">Total
                        Tabungan :</div>
                    <div class="col-7 mb-2 pl-0 dtb" style="display:none;">
                        <input type="text" class="form-control form-control-sm bg-white" placeholder="" name="tabungan"
                            id="tabungan" value=readonly>
                    </div>
                </form>
            </div><!-- end print -->
        </div><!-- end col-lg-9 -->

    </div>
</div>


<?php
if (isset($_POST['save'])) {
    $nonota     = $_POST['no_nota'];
    $idpel      = $_POST['idpelanggan'];
    $total      = $_POST['total'];
    $catatan    = htmlspecialchars($_POST['catatan']);
    $insert     = mysqli_query($conn, "INSERT INTO tabungan (notransaksi,idpelanggan,total,catatan) VALUES ('$nonota','$idpel','$total','$catatan')");
    if ($insert) {
        echo '<script>window.location="tabungan.php"</script>';
    } else {
        echo '<script>window.location="tabungan.php"</script>';
    }
}
?>
<script type="text/javascript">
<?php echo $jsArray, $jsArray1, $jsArray3, $jsArray4, $jsArrayp, $jsArrayp1, $jsArrayp2; ?>

function changeValuePelanggan(nama_pelanggan) {
    document.getElementById("telepon_pelanggan").value = telepon_pelanggan[nama_pelanggan].telepon_pelanggan;
    document.getElementById("alamat_pelanggan").value = alamat_pelanggan[nama_pelanggan].alamat_pelanggan;
    document.getElementById("idpelanggan").value = idpelanggan[nama_pelanggan].idpelanggan;
    var mtd = document.getElementById('mtd').value;
    var id = document.getElementById('idpelanggan').value = idpelanggan[nama_pelanggan].idpelanggan;
    if (mtd != 0) {
        $(".dtb").show();
    } else {
        $(".dtb").hide();
    }

    $.ajax({
        type: 'POST',
        url: "gettotaltabunganlaporan.php",
        data: {
            id: id,
            mtd: mtd
        },
        success: function(data) {
            $("#tabungan").val(data);
        }
    });
};

timer();

function timer() {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    document.getElementById('date-time').value = dateTime;
    setTimeout(timer, 1000);
}

function TambahBaru() {
    var x = document.getElementById("Ada1");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    var y = document.getElementById("Tambah1");
    if (y.style.display === "block") {
        y.style.display = "none";
    } else {
        y.style.display = "block";
    }
}
</script>
<?php include 'template/footer.php'; ?>