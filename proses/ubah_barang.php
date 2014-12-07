<?php require_once "../config/SimplePDO.php";
 $params = array(
     'host' => 'localhost', 
     'user' => 'root', 
     'password' => '', 
     'database' => 'db_inventory_scm'
 );
 
//Set the options
SimplePDO::set_options( $params );
$database = SimplePDO::getInstance();

if(isset($_POST['submit'])){
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$deskripsi = $_POST['deskripsi'];
	$stok_barang = $_POST['stok_barang'];
    $update = array(
                     "nama_barang"=>$nama_barang,
                     "deskripsi_barang"=>$deskripsi,
                     "stok_barang"=>$stok_barang,
                     "kode_admin"=>"ADM001",
                   );
    $u_where = array("kode_barang"=>$kode_barang);
    $database->update("tb_barang",$update,$u_where);
	header('location:../main.php?hal=daftar_barang&st=1');
}
?>