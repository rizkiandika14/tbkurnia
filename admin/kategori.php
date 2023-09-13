
<?php include 'template/header.php';?>
<br>
<?php
            if(isset($_POST['addkategori']))
            {
                $namakategori = htmlspecialchars($_POST['nama_kategori']);    
                $tambahkat = mysqli_query($conn,"INSERT INTO kategori (nama_kategori) values ('$namakategori')");
                if ($tambahkat){
                    echo '<script>alert("Berhasil Menambahkan Data");window.location="kategori.php"</script>';
                } else {
                    echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
                }
                
            };
			
            if(isset($_POST['updateKategori'])){
                $idkategori = htmlspecialchars($_POST['idkategori']);
                $namakategori = htmlspecialchars($_POST['nama_kategori']);


                mysqli_query($conn,"UPDATE kategori SET nama_kategori='$namakategori' WHERE idkategori='$idkategori' ");
                echo '<script>alert("Berhasil Update Kategori");window.location="kategori.php"</script>';
            };
			
            ?>
<div class="card">
    <div class="card-header">
        <div class="card-tittle"><i class="fa fa-table me-2 d-none d-sm-inline-block d-md-inline-block"></i> Data Kategori 
        <?php 
            if(!empty($_GET['edit'])){
                $idkategori = $_GET['edit'];
                $edit = mysqli_query($conn,"SELECT * FROM kategori WHERE idkategori='$idkategori'");
                while($e=mysqli_fetch_array($edit)){
                    $namo= $e['nama_kategori'];
                    echo '<form method="POST" class="float-right">
                    <div class="input-group">
                        <input type="text" name="nama_kategori" class="form-control form-control-sm bg-white"
                        style="border-radius:0.428rem 0px 0px 0.428rem;"
                        placeholder="Masukan Kategori" value="'.$namo.'" required>
                        <div class="input-group-append">
                            <button class="btn btn-success btn-xs p-1" name="update"
                            style="border-radius: 0px 0.428rem 0.428rem 0px;" type="submit">
                                <i class="fas fa-check"></i><span class="d-none d-sm-inline-block d-md-inline-block ml-1">Update</span>
                            </button>
                            <a href="kategori.php" class="btn btn-danger btn-xs py-1 px-2 ml-1"><i class="fas fa-times"></i>
                            <span class="d-none d-sm-inline-block d-md-inline-block ml-1">Batal</span></a>
                        </div>
                    </div>
                </form>';
                }
            } else { ?>
                <form method="POST" class="float-right">
                <div class="input-group">
                    <input type="text" name="nama_kategori" class="form-control form-control-sm bg-white"
                    style="border-radius:0.428rem 0px 0px 0.428rem;"
                    placeholder="Masukan Kategori" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-xs p-1" name="addkategori"
                        style="border-radius: 0px 0.428rem 0.428rem 0px;" type="submit">
                            <i class="fa fa-plus"></i><span class="d-none d-sm-inline-block d-md-inline-block ml-1">Tambah</span>
                        </button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Qty</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $data_produk=mysqli_query($conn,"SELECT * FROM kategori ORDER BY idkategori ASC");
                                while($d=mysqli_fetch_array($data_produk)){
                                    $idkategori = $d['idkategori'];
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['nama_kategori'] ?></td>
                                        <td><?php 
                                            $result1 = mysqli_query($conn,"SELECT Count(idproduk) AS count FROM produk p, kategori k WHERE p.idkategori=k.idkategori and k.idkategori='$idkategori' ORDER BY idproduk ASC");
                                            $cekrow = mysqli_num_rows($result1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $count = $row1['count'];
                                            if($cekrow > 0){
                                            echo ribuan($count);
                                            }
                                        ?></td>
                                        <td><?php echo $d['tgl_dibuat'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs"
                                             data-toggle="modal" data-target="#editK<?php echo $idkategori ?>">
                                             <i class="fa fa-pen fa-xs mr-1"></i>Edit</button>
										
                                            <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $idkategori ?>" 
                                            onclick="javascript:return confirm('Hapus Data produk - <?php echo $d['nama_kategori'] ?> ?');">
                                            <i class="fa fa-trash fa-xs mr-1"></i>Hapus</a>
                                        </td>
                                    </tr>

                                    <!-- modal edit -->
                                    <div class="modal fade" id="editK<?php echo $idkategori ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTittle2" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTittle2"><i class="fa fa-shopping-bag mr-1 text-muted"></i> Edit Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-2">
                                                    <label>Nama Kategori:</label>
                                                    <input type="hidden" name="idkategori" class="form-control" value="<?php echo $d['idkategori'] ?>">
                                                    <input type="text" name="nama_kategori" class="form-control" value="<?php echo $d['nama_kategori'] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-xs p-2" data-dismiss="modal">
                                                    <i class="fa fa-times mr-1"></i> Batal</button>
                                                <button type="submit" class="btn btn-primary btn-xs p-2" name="updateKategori">
                                                <i class="fa fa-plus-circle mr-1"></i> Simpan</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    <!-- end modal edit -->

									
                        <?php }?>
					</tbody>
                </table>
        </div>
</div>

<?php 
	if(!empty($_GET['hapus'])){
		$idkategori = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM kategori WHERE idkategori='$idkategori'");
        if($hapus_data){
            echo '<script>alert("Berhasi Hapus Kategori");window.location="kategori.php"</script>';
        } else {
            echo '<script>alert("gagal Hapus Kategori");history.go(-1);</script>';
        }
	};
    ?>
<?php include 'template/footer.php';?>
