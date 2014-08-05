<?php
include"../config/kodefikasi.php";
include"../config/cek_session.php";

if(isset($_POST['submit'])){
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $stok_barang = $_POST['stok_barang'];
	$data=mysql_query("INSERT INTO tb_barang VALUES('".kodefikasi('tb_barang','kode_barang','BRG')."','".$nama_barang."','".$deskripsi."','".$stok_barang."','".$_SESSION['admin_id']."')") or die(mysql_error());
    if($data>0){
        header('location:../main.php?hal=daftar_barang&st=1');
    }else{
        echo "Error";
    }
}
?>