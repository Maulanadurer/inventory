<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
	$kode_user = $_POST['kode_user'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$c_password = $_POST['c_password'];
	$nama_user = $_POST['nama_user'];
	$email_user = $_POST['email_user'];
	$kode_cabang = $_POST['kode_cabang'];
        $query = "UPDATE tb_user SET username_user='".$username."',nama_user='".$nama_user."',email_user='".$email_user."',kode_cabang='".$kode_cabang."' WHERE kode_user = '".$kode_user."'";
        $data = mysql_query($query) or die(mysql_error());
        if($data>0){
		header('location:../main.php?hal=daftar_user&st=1');
	}else{
		echo "Error";
	}
}
?>