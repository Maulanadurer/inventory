<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
	$nama_cabang = $_POST['nama_cabang'];
	$alamat = $_POST['alamat_cabang'];
	$telepon_cabang = $_POST['telepon_cabang'];
	$data=mysql_query("INSERT INTO tb_cabang VALUES('".kodefikasi('tb_cabang','kode_cabang','CAB')."','".$nama_cabang."','".$alamat."','".$telepon_cabang."','".$_SESSION['admin_id']."')") or die(mysql_error());
	if($data>0){
		header('location:../main.php?hal=daftar_cabang&st=1');
	}else{
		echo "Error";
	}
}
?>