<?php
include "config.php";
    $mrd         = $_POST['mtd'];
    $idpelanggan = $_POST['id'];
	if($mrd==2){
		$cek = mysqli_query($conn,"SELECT sum(total) as total FROM tabungan WHERE idpelanggan='$idpelanggan'");
		$row = mysqli_fetch_array($cek);
		$ttl = $row['total'];
		if($ttl > 0 ){
			echo $row['total'];
		}else{
			echo 0;
		}
	}else{
		echo 0;
	}
?>