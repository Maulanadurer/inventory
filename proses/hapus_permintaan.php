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

if(isset($_GET['kode'])){
    $kode = $_GET['kode'];
    $where = array("kode"=>$kode);
    $resp = $database->delete("temp_permintaan",$where,1);
    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=input_permintaan');
    //}
}
?>