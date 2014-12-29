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
    $barang = explode("|",$_POST['kode_barang']);
    $kode_supplier = $_POST['kode_supplier'];
    $jumlah = $_POST['jumlah'];
    $data = array(
                  "kode"=>null,
                  "kode_barang"=>$barang[0],
                  "nama_barang"=>$barang[1],
                  "kode_supplier"=>$kode_supplier,
                  "jumlah"=>$jumlah
                );
    $resp = $database->insert("temp_pesan",$data);
    //if($resp == 0){
//    }else{
        header('location:../main.php?hal=pemesanan_barang');
    //}
}
?>