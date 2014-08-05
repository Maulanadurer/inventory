<?php
include"koneksi.php";
function kodefikasi($nama_tbl,$nama_field,$prefix){
	$kode = "";$num = 0;
	$data = mysql_query("SELECT MAX(".$nama_field.") AS kode FROM ".$nama_tbl."")or die(mysql_error());
	$row = mysql_fetch_array($data);
	if(mysql_num_rows($data)!=0){
		$num = (int) substr($row['kode'],-3);
		$num++;
		$kode = $prefix . sprintf("%03s", $num);
	}else{
		$kode = $prefix."001";
	}
	return $kode;
}
?>