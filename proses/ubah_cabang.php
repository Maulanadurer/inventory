<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
	$kode_cabang = $_POST['kode_cabang'];
	$nama_cabang = $_POST['nama_cabang'];
	$alamat = $_POST['alamat_cabang'];
	$telepon_cabang = $_POST['telepon_cabang'];
	$data=mysql_query("UPDATE tb_cabang SET nama_cabang='".$nama_cabang."',alamat_cabang='".$alamat."',telepon_cabang='".$telepon_cabang."',kode_admin='".$_SESSION['admin_id']."' WHERE kode_cabang = '".$kode_cabang."'") or die(mysql_error());
	if($data>0){
		header('location:../main.php?hal=daftar_cabang&st=1');
	}else{
		echo "Error";
	}
}
?>