<?php 
require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";
 $params = array(
     'host' => host, 
     'user' => user, 
     'password' => password, 
     'database' => database
 );
 
//Set the options
SimplePDO::set_options( $params );
$database = SimplePDO::getInstance();

if(isset($_POST['submit'])){
    require_once "../config/kodefikasi.php";
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $stok_barang = $_POST['stok_barang'];
    $data = array(
                  "kode_barang"=>kodefikasi('tb_barang','kode_barang','BRG'),
                  "nama_barang"=>$nama_barang,
                  "deskripsi_barang"=>$deskripsi,
                  "stok_barang"=>$stok_barang,
                  "kode_admin"=>"ADM001",
                );
    $database->insert("tb_barang",$data);
    header('location:../main.php?hal=daftar_barang&st=1');
}
?>