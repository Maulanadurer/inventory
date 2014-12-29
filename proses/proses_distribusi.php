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
    $status = $_POST['status'];
    $kode = $_POST['id_distribusi'];   
  
    $update = array("status"=>$status, "tgl_distribusi"=>"NOW()");
    $where = array("id_distribusi"=>$kode);
    $database->update("tb_distribusi_brg", $update, $where, 1);

    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=daftar_distribusi');
    //}
}
?>