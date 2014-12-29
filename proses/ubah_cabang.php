<?php require_once "../config/SimplePDO.php";
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
	$kode_cabang = $_POST['kode_cabang'];
    $nama_cabang = $_POST['nama_cabang'];
    $alamat_cabang = $_POST['alamat_cabang'];
    $telepon_cabang = $_POST['telepon_cabang'];
    $update = array(
                  "nama_cabang"=>$nama_cabang,
                  "alamat_cabang"=>$alamat_cabang,
                  "telepon_cabang"=>$telepon_cabang,
                  "kode_admin"=>"ADM001",
                );
    $u_where = array("kode_cabang"=>$kode_cabang);
    $database->update("tb_cabang",$update,$u_where);
	header('location:../main.php?hal=daftar_cabang&st=1');
}
?>