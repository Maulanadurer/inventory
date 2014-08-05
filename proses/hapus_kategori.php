<?php
include"../config/cek_session.php";
include"../config/koneksi.php";
$data=mysql_query("DELETE FROM tb_kategori WHERE kode_kategori='".$_GET['id']."'") or die(mysql_error());
if($data>0){
	header('location:../main.php?hal=kategori_barang&st=1');
}else{
	echo "Error";
}
?>