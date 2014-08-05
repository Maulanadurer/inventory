<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
	$kode_admin = $_POST['kode_admin'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$c_password = $_POST['c_password'];
	$nama_admin = $_POST['nama_admin'];
	$email_admin = $_POST['email_admin'];
	$level = $_POST['level'];
        $query = "UPDATE tb_admin SET username_admin='".$username."',nama_admin='".$nama_admin."',email_admin='".$email_admin."',level='".$level."' WHERE kode_admin = '".$kode_admin."'";
        $data = mysql_query($query) or die(mysql_error());
        if($data>0){
		header('location:../main.php?hal=daftar_barang&st=1');
	}else{
		echo "Error";
	}
}
?>