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
    $nama_cabang = $_POST['nama_cabang'];
    $alamat_cabang = $_POST['alamat_cabang'];
    $telepon_cabang = $_POST['telepon_cabang'];
    $data = array(
                  "kode_cabang"=>kodefikasi('tb_cabang','kode_cabang','CAB001'),
                  "nama_cabang"=>$nama_cabang,
                  "alamat_cabang"=>$alamat_cabang,
                  "telepon_cabang"=>$telepon_cabang,
                  "kode_admin"=>"ADM001",
                );
    $database->insert("tb_cabang",$data);
    header('location:../main.php?hal=daftar_cabang&st=1');
}
?>