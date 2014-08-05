<?php
include"../config/cek_session.php";
include"../config/koneksi.php";
$data=mysql_query("DELETE FROM tb_jenistransaksi WHERE id_jenistransaksi='".$_GET['id']."'") or die(mysql_error());
if($data>0){
	header('location:../main.php?hal=jenis_transaksi&st=1');
}else{
	echo "Error";
}
?>