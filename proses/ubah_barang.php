<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$deskripsi = $_POST['deskripsi'];
	$stok_barang = $_POST['stok_barang'];
	$data=mysql_query("UPDATE tb_barang SET nama_barang='".$nama_barang."',deskripsi_barang='".$deskripsi."',stok_barang='".$stok_barang."',kode_admin='".$_SESSION['admin_id']."' WHERE kode_barang = '".$kode_barang."'") or die(mysql_error());
	if($data>0){
		header('location:../main.php?hal=daftar_barang&st=1');
	}else{
		echo "Error";
	}
}
?>