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
    $status = $_POST['status'];
    $kode = $_POST['id_distribusi'];
    $tanggal = $_POST['tgl_distribusi'];
  
    $update = array("status"=>$status, "tgl_distribusi"=>$tanggal);
    $where = array("id_distribusi"=>$kode);
    $database->update("tb_distribusi_brg", $update, $where, 1);

    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=daftar_distribusi');
    //}
}
?>