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
$database->delete("tb_supplier",array("kode_supplier"=>$_GET['kode']));
header('location:../main.php?hal=daftar_supplier&st=1');
?>