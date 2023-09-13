<?php include 'template/header.php'; ?>
<br>

<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2"></i> Data Produk
            <div class="float-right">
                <button type="button" class="btn btn-primary btn-xs p-2" data-toggle="modal" data-target="#addsatuan">
                    <i class="fa fa-plus fa-xs mr-1"></i> Tambah Satuan</button>
                <button type="button" class="btn btn-primary btn-xs p-2" data-toggle="modal" data-target="#addstok">
                    <i class="fa fa-plus fa-xs mr-1"></i> Tambah Stok</button>
                <button type="button" class="btn btn-primary btn-xs p-2" data-toggle="modal" data-target="#addproduk">
                    <i class="fa fa-plus fa-xs mr-1"></i> Tambah Produk</button>
            </div>
        </div>
        <br>
        <div class="float-right">
            <a href="laporan_produk.php"><button type="button" class="btn btn-info btn-xs p-2"> <i
                        class="far fa-file mr-1"></i>
                    Laporan Stok</button></a>
            <a href="laporan_produkk.php"><button type="button" class="btn btn-info btn-xs p-2"> <i
                        class="far fa-file mr-1"></i>
                    Laporan Produk</button></a>
        </div>

    </div>
    <div class="card-body">
        <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
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
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data_produk = mysqli_query($conn, "SELECT kategori.*,stock.*,produk.* FROM kategori JOIN produk ON kategori.idkategori=produk.idkategori INNER JOIN stock ON produk.idproduk=stock.idproduk group by produk.idproduk ASC");
                while ($d = mysqli_fetch_array($data_produk)) {
                    $idproduk = $d['idproduk'];
                ?>

                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><a href="stok.php?idproduk=<?= $d['idproduk'] ?>"><?php echo $d['kode_produk'] ?></a></td>
                    <td><a href="stok.php?idproduk=<?= $d['idproduk'] ?>"><?php echo $d['nama_produk'] ?></a></td>
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
                    <td>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                            data-target="#editP<?php echo $idproduk ?>">
                            <i class="fa fa-pen fa-xs mr-1"></i>Edit</button>
                        <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $idproduk ?>"
                            onclick="javascript:return confirm('Hapus Data produk - <?php echo $d['nama_produk'] ?> ?');">
                            <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                    </td>
                </tr>

                <!-- modal edit -->
                <div class="modal fade" id="editP<?php echo $idproduk ?>" tabindex="-1" role="dialog"
                    aria-labelledby="ModalTittle2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalTittle2"><i
                                            class="fa fa-shopping-bag mr-1 text-muted"></i> Edit
                                        Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label>Kode Produk :</label>
                                        <input type="hidden" name="idproduk1" class="form-control"
                                            value="<?php echo $d['idproduk'] ?>">
                                        <input type="text" name="kode_produk1" class="form-control"
                                            value="<?php echo $d['kode_produk'] ?>" readonly>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Nama Produk :</label>
                                        <input type="text" name="nama_produk1" class="form-control"
                                            value="<?php echo $d['nama_produk'] ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Detail Produk (Merk) :</label>
                                        <input type="text" name="detail_produk1" class="form-control"
                                            value="<?php echo $d['detail'] ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Kategori Produk :</label>
                                        <select name="idkategori1" class="form-control" required>
                                            <option value="<?php echo $d['idkategori'] ?>" class="small">
                                                <?php echo $d['nama_kategori'] ?></option>
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
                                        <select name="satuan1" class="form-control" required>
                                            <option value="<?php echo $d['satuan'] ?>" class="small">
                                                <?php echo $d['satuan'] ?></option>
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
                                            <input type="number" name="stock" class="form-control"
                                                value="<?php echo $d['stock'] ?>" required readonly>
                                        </div> -->
                                        <div class="col-5 col-md-5 pr-0">
                                            <label>Harga Modal :</label>
                                            <input type="number" name="harga_modal1"
                                                value="<?php echo $d['harga_modal'] ?>" class="form-control" required>
                                        </div>
                                        <div class="col-5 col-md-5">
                                            <label>Harga Jual :</label>
                                            <input type="number" name="harga_jual1"
                                                value="<?php echo $d['harga_jual'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                                        <i class="fa fa-times mr-1"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary btn-xs p-2" name="updateProduk">
                                        <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- end modal edit -->
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'modals.php'; ?>
<?php include 'template/footer.php'; ?>