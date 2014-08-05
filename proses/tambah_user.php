<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
//	$admin_id = $_POST['id_admin'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_user = $_POST['nama_user'];
	$email_user = $_POST['email_user'];
        $kode_cabang = $_POST['kode_cabang'];
	$data=mysql_query("INSERT INTO tb_user VALUES('".kodefikasi('tb_user','kode_user','USR')."','".$username."',md5('".$password."'),'".$nama_user."','".$email_user."','".$kode_cabang."','".$_SESSION['admin_id']."')") or die(mysql_error());
	if($data>0){
		header('location:../main.php?hal=daftar_user&st=1');
	}else{
		echo "Error";
	}
}
?>