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
    require_once "../config/kodefikasi.php";
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $data = array(
                  "kode_supplier"=>kodefikasi('tb_supplier','kode_supplier','SUP'),
                  "nama_supplier"=>$nama_supplier,
                  "alamat_supplier"=>$alamat,
                  "kode_admin"=>"ADM001",
                );
    $database->insert("tb_supplier",$data);
    header('location:../main.php?hal=daftar_supplier&st=1');
}
?>