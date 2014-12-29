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
$database->delete("tb_supplier",array("kode_supplier"=>$_GET['kode']));
header('location:../main.php?hal=daftar_supplier&st=1');
?>