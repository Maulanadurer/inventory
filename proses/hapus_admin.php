<?php
include"../config/cek_session.php";
include"../config/koneksi.php";
$data=mysql_query("DELETE FROM tb_admin WHERE kode_admin='".$_GET['id']."'") or die(mysql_error());
if($data>0){
	header('location:../main.php?hal=daftar_admin&st=1');
}else{
	echo "Error";
}
?>