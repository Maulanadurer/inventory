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
	$kode_supplier = $_POST['kode_supplier'];
	$nama_supplier= $_POST['nama_supplier'];
	$alamat = $_POST['alamat'];
    $update = array(
                     "nama_supplier"=>$nama_supplier,
                     "alamat_supplier"=>$alamat,
                     "kode_admin"=>"ADM001",
                   );
    $u_where = array("kode_supplier"=>$kode_supplier);
    $database->update("tb_supplier",$update,$u_where);
	header('location:../main.php?hal=daftar_supplier&st=1');
}
?>