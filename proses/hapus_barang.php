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
$database->delete("tb_barang",array("kode_barang"=>$_GET['kode']));
header('location:../main.php?hal=daftar_barang&st=1');
?>